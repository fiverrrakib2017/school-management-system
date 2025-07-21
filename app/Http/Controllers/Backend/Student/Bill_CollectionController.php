<?php
namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Section;
use App\Models\Student_bill_collection;
use App\Models\Student_bill_collection_item;
use App\Models\Student_fees_type;
use App\Models\Website_information;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use function App\Helpers\send_message;
class Bill_CollectionController extends Controller
{

    public function index()
    {
       $class=Student_class::get();
       return view('Backend.Pages.Student.Bill_Collection.index',compact('class'));
    }
    public function create_bill(){
        $students=Student::latest()->get();
        $fess_type=Student_fees_type::latest()->get();
        $sections=Section::latest()->get();
        return view('Backend.Pages.Student.Bill_Collection.create',compact('students','fess_type','sections'));
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'student.name', 'student.currentClass.name', 'student.section.name', 'total_amount', 'paid_amount','due_amount','payment_status','note','created_at']; // Update the column names correctly
        $orderByColumnIndex = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
        $orderByColumn = $columnsForOrderBy[$orderByColumnIndex];

        /*Start building the query*/
        $query = Student_bill_collection::with('student', 'student.currentClass','student.section');

        /*Apply the search filter*/
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('student', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('student.currentClass', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('student.section', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhere('total_amount', 'like', "%$search%")
                ->orWhere('paid_amount', 'like', "%$search%")
                ->orWhere('due_amount', 'like', "%$search%")
                ->orWhere('payment_status', 'like', "%$search%");
            });
        }

        /* Get the total count of records*/
        $totalRecords = Student_bill_collection::count();

        /* Get the count of filtered records*/
        $filteredRecords = $query->count();

        /* Filter by class_id */
        if ($request->has('class_id') && !empty($request->class_id)) {
            $query->whereHas('student.currentClass', function ($q) use ($request) {
                $q->where('id', $request->class_id);
            });
        }
        /* Apply ordering, pagination and get the data*/
        $items = $query->orderBy($orderByColumn, $orderDirection)
                    ->skip($request->start)
                    ->take($request->length)
                    ->get();

        /* Return the response in JSON format*/
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $items,
        ]);
    }

    public function store(Request $request){
        //return $request->all(); exit;
        $rules = [
            'student_id' => 'required|exists:students,id',
            'total_amount' => 'nullable|numeric',
            'paid_amount' => 'nullable|numeric',
            'due_amount' => 'nullable|numeric',
            'discount_amount' => 'nullable|numeric',
            'payment_status' => 'nullable|in:paid,unpaid,due',
            'payment_method' => 'nullable|in:cash,cheque,card,bkash,other',
            'note' => 'nullable|string',
            'billing_item_id' => 'required|array',
            'billing_item_id.*' => 'exists:student_fees_types,id',
            'amount.*' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $object = new Student_bill_collection();
            $object->student_id = $request->student_id;
            $object->total_amount = $request->total_amount ?? 0;
            $object->paid_amount = $request->paid_amount ?? 0;
            $object->due_amount = $request->due_amount ?? 0;
            $object->discount_amount = $request->discount_amount ?? 0;
            $object->payment_status = 'paid';
            $object->payment_method = 'cash';
            $object->note = $request->note;
            $object->save();

            foreach ($request->billing_item_id as $key => $feesTypeId) {
                $item = new Student_bill_collection_item();
                $item->bill_collection_id = $object->id;
                $item->fees_type_id = $feesTypeId;
                $item->amount = $request->amount[$key];
                $item->month = $request->month_name[$key];
                $item->year = date('Y');
                $item->status = 1;
                $item->save();
            }

            /* Send Message to the Student*/
            if($request->send_sms==1){
                $student = Student::find($request->student_id);
                //=== Student Fees Details Message Generate ===//

                $fees_details = '';
                foreach ($request->billing_item_id as $key => $feesTypeId) {
                    $feeType = \App\Models\Student_fees_type::find($feesTypeId);
                    $month = $request->month_name[$key] ?? '';
                    $amount = number_format($request->amount[$key], 2);
                    $fees_details .= "- {$feeType->type_name}" . ($month ? " ({$month})" : "") . ": {$amount}৳\n";
                }
                $total = number_format($request->total_amount ?? 0, 2);
                $paid = number_format($request->paid_amount ?? 0, 2);
                $due = number_format($request->due_amount ?? 0, 2);
                $date = date('d-m-Y');

                $website_info = Website_information::first();

                $message = "📄 বিল সংগ্রহের তথ্য\n"
                        . "👤 শিক্ষার্থী: {$student->name}\n"
                        . "📅 তারিখ: {$date}\n"
                        . "-------------------\n"
                        . "$fees_details"
                        . "-------------------\n"
                        . "💰 মোট: {$total}৳\n"
                        . "✅ পরিশোধ: {$paid}৳\n"
                        . "❗ বাকি: {$due}৳\n"
                        . "ধন্যবাদ। - {$website_info->name}\n";

                $send_message= new \App\Models\Send_message();
                $send_message->student_id = $student->id;
                $send_message->class_id = $student->current_class;
                $send_message->section_id = $student->section_id;
                $send_message->message = $message;
                $send_message->save();
                /*Call Send Message Function */
                send_message($student->phone, $message);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Bill Collection Added Successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Transaction Rolled Back!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id){
        $student=Student::latest()->get();
         $data = Student_bill_collection::with('items', 'items.fees_type')->find($id);
        return view('Backend.Pages.Student.Bill_Collection.update',compact('data','student'));
    }
   public function update(Request $request , $id){
    /* Validate the form data*/
    $rules=[
        'student_id' => 'required|exists:students,id',
        'total_amount' => 'nullable|numeric',
        'paid_amount' => 'nullable|numeric',
        'due_amount' => 'nullable|numeric',
        'discount_amount' => 'nullable|numeric',
        'payment_status' => 'nullable|in:paid,unpaid,due',
        'payment_method' => 'nullable|in:cash,cheque,card,bkash,other',
        'note' => 'nullable|string',
        'billing_item_id' => 'required|array',
        'billing_item_id.*' => 'exists:student_fees_types,id',
        'amount.*' => 'required|numeric',
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

     /* Create a new Instance*/
     $object = Student_bill_collection::findOrFail($id);
     $object->student_id =$request->student_id;
     $object->total_amount = $request->total_amount ?? $request->amount;
     $object->paid_amount= $request->paid_amount ?? 0;
     $object->due_amount = $request->due_amount ?? ($request->amount - $request->paid_amount);
     $object->discount_amount = $request->discount_amount ?? 0;
     $object->payment_status = 'paid';
     $object->payment_method = 'cash';
     $object->note = $request->note;
     /*Save to the database table*/
     $object->save();

    $object->items()->delete();

    foreach ($request->billing_item_id as $key => $feesTypeId) {
        $item=new Student_bill_collection_item();
        $item->bill_collection_id=$object->id;
        $item->fees_type_id=$feesTypeId;
        $item->amount=$request->amount[$key];
        $item->status=1;
        $item->save();
    }

    return response()->json([
        'success' => true,
        'message' => 'Updated Successfully'
    ]);
   }
   public function invoice_show($id){
     $data = Student_bill_collection::with('items','student', 'items.fees_type')->find($id);
    return view('Backend.Pages.Student.Bill_Collection.Invoice.invoice_view',compact('data'));
   }
    public function delete(Request $request){
        $object = Student_bill_collection::find($request->id);
        $object->delete();
        return response()->json([
            'success' => true,
            'message' => 'Delete Successfully'
        ]);
    }
    public function get_student_due_amount($student_id){
        if(!empty($student_id)){
           $due_amount= Student_bill_collection::where('student_id',$student_id)->sum('due_amount');
           $formattedAmount = round($due_amount);
           return response()->json([
               'success' => true,
               'data' => $formattedAmount
           ]);
        }else{
            return response()->json([
                'success' => false,
                'data' => 'No data found'
            ]);
        }
    }
}
