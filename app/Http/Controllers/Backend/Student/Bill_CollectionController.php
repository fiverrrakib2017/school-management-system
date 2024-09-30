<?php
namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Section;
use App\Models\Student_bill_collection;
use App\Models\Student_bill_collection_item;
use App\Models\Student_fees_type;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Bill_CollectionController extends Controller
{

    public function index()
    {
       $student=Student::get();
       return view('Backend.Pages.Student.Bill_Collection.index',compact('student'));
    }
    public function create_bill(){
        $student=Student::latest()->get();
        $fess_type=Student_fees_type::latest()->get();
        return view('Backend.Pages.Student.Bill_Collection.create',compact('student','fess_type'));
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'student_id', 'amount', 'paid_amount','due_amount','payment_status','note','created_at'];
        $orderByColumnIndex = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
        $orderByColumn = $columnsForOrderBy[$orderByColumnIndex];

        /*Start building the query*/
        $query = Student_bill_collection::with('student');

        /*Apply the search filter*/
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('amount', 'like', "%$search%")
                  ->orWhere('payment_status', 'like', "%$search%")
                  ->orWhereHas('student', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
            });
        }

        /* Get the total count of records*/
        $totalRecords = Student_bill_collection::count();

        /* Get the count of filtered records*/
        $filteredRecords = $query->count();

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
        //return $request->all();
        /* Validate the form data*/
        $rules=[
            'student_id' => 'required|exists:students,id',
            //'amount' => 'required|numeric',
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
        $object = new Student_bill_collection();
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
            'message' => 'Added Successfully'
        ]);
    }
   
    public function delete(Request $request){
        $object = Student_bill_collection::find($request->id); 
        $object->delete(); 
        return response()->json([
            'success' => true,
            'message' => 'Delete Successfully'
        ]);
    }
}