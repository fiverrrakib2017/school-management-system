<?php
namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Section;
use App\Models\Student_attendance;
use App\Models\Student_bill_collection;
use App\Models\Student_shift;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class Attendance_controller extends Controller
{

    public function index()
    {
       $shift=Student_shift::get();
       $student=Student::get();
       return view('Backend.Pages.Student.Attendance.index',compact('student','shift'));
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'student_name','attendace_date','shift_name','time_in','time_out', 'status'];
        $orderByColumnIndex = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
        $orderByColumn = $columnsForOrderBy[$orderByColumnIndex];

        /*Start building the query*/
        $query = Student_attendance::with('student','shift');

        /*Apply the search filter*/
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('status', 'like', "%$search%")
                ->where('time_in', 'like', "%$search%")
                  ->orWhere('time_out', 'like', "%$search%")
                  ->orWhereHas('student', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('shift', function($q) use ($search) {
                      $q->where('shift_name', 'like', "%$search%");
                  });
            });
        }

        /* Get the total count of records*/
        $totalRecords = Student_attendance::count();

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
        $rules = [
            'student_id' => 'required|exists:students,id',
            'attendance_date' => 'required|date',
            'shift_id' => 'required|exists:student_shifts,id',
            'time_in' => 'required',
            'time_out' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }


        /* Create a new Instance*/
        $object = new Student_attendance();
        $object->student_id = $request->student_id;
        $object->attendance_date = $request->attendance_date;
        $object->shift_id = $request->shift_id;
        $object->time_in = Carbon::createFromFormat('H:i', $request->time_in)->format('H:i:s'); 
        $object->time_out =Carbon::createFromFormat('H:i', $request->time_out)->format('H:i:s'); 
        $object->status = $request->status ?? 'Present';
        /*Save to the database table*/
        $object->save();
        return response()->json([
            'success' => true,
            'message' => 'Added Successfully'
        ]);
    }
    public function get_attendance($id){
        $data = Student_attendance::find($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    public function update(Request $request){
        /* Validate the form data */
        $rules = [
            'student_id' => 'required|exists:students,id',
            'attendance_date' => 'required|date',
            'shift_id' => 'required|exists:student_shifts,id',
            'time_in' => 'required',
            'time_out' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        /* Find the existing instance */
        $object = Student_attendance::find($request->id);
        if (!$object) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }

        /* Update the Instance */
        $object->student_id = $request->student_id;
        $object->attendance_date = $request->attendance_date;
        $object->shift_id = $request->shift_id;
        $object->time_in =$request->time_in;
        $object->time_out =$request->time_out; 
        $object->status = $request->status ?? 'Present';

        /* Save the changes to the database table */
        $object->update();

        return response()->json([
            'success' => true,
            'message' => 'Updated Successfully'
        ]);
    }

    public function delete(Request $request){
        $object = Student_attendance::find($request->id); 
        $object->delete(); 
        return response()->json([
            'success' => true,
            'message' => 'Delete Successfully'
        ]);
    }
}