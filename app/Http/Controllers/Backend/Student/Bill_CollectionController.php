<?php
namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Section;
use App\Models\Student_bill_collection;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Bill_CollectionController extends Controller
{

    public function index()
    {
       $student=Student::get();
       return view('Backend.Pages.Student.Bill_Collection',compact('student'));
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
        $totalRecords = Student_class::count();

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
        /* Validate the form data*/
        $rules=[
            'student_id' => 'required|exists:students,id',
            'bill_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }


        /* Create a new Supplier*/
       


        $object = new Student_bill_collection();
        $object->student_id = $request->student_id;
        $object->bill_date=$request->bill_date;
        $object->amount = $request->amount;
        $object->paid_amount = $request->paid_amount;
        $object->due_amount = $request->due_amount;
        $object->payment_status = $request->due_amount == 0 ? 'paid' : ($request->due_amount < $request->amount ? 'partial' : 'due');
        $object->payment_method = $request->payment_method;
        $object->note = $request->note;
        /*Save to the database table*/
        $object->save();
        return response()->json([
            'success' => true,
            'message' => 'Added Successfully'
        ]);
    }
    public function get_bill_collection($id){
        $data = Student_bill_collection::find($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    public function update(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'bill_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $object =Student_bill_collection::find($request->id);
        $object->student_id = $request->student_id;
        $object->bill_date=$request->bill_date;
        $object->amount = $request->amount;
        $object->paid_amount = $request->paid_amount;
        $object->due_amount = $request->due_amount;
        $object->payment_status = $request->due_amount == 0 ? 'paid' : ($request->due_amount < $request->amount ? 'partial' : 'due');
        $object->payment_method = $request->payment_method;
        $object->note = $request->note;
        /*Update to the database table*/
        $object->update();
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