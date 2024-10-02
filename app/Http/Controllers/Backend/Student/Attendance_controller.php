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
      $sections=Section::latest()->get();
       $shift=Student_shift::get();
       $student=Student::get();
        $classes=Student_class::with('section')->latest()->get();
       return view('Backend.Pages.Student.Attendance.index',compact('student','shift','classes','sections'));
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name', 'current_class','section','created_at'];
        $orderByColumn = $columnsForOrderBy[$request->order[0]['column']];
        $orderDirection = $request->order[0]['dir'];
    
        $query = Student::with(['currentClass', 'section'])->when($search, function ($query) use ($search) {

            $query->where('name', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhereHas('currentClass', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('section', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%");
                  });
        });
    
        if ($request->has('class_id') && !empty($request->class_id)) {
            $query->where('current_class', $request->class_id);
        }
        if ($request->has('section_id') && !empty($request->section_id)) {
            $query->where('section_id', $request->section_id);
        }
    
        $total = $query->count();
        $items = $query->orderBy($orderByColumn, $orderDirection)
                       ->skip($request->start)
                       ->take($request->length)
                       ->get();
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items,
        ]);
    }
    public function store(Request $request){
        $studentIds = $request->input('student_ids');
    
        if (!empty($studentIds)) {
            foreach ($studentIds as $studentId) {

                $object = new Student_attendance();
                $object->student_id = $studentId;
                $object->attendance_date =now();
                $object->shift_id = 1;
                $object->time_in = Carbon::now()->format('H:i:s'); 
                $object->time_out =NULL; 
                $object->status = 'Present';
                /*Save to the database table*/
                $object->save();


            }
            return response()->json([
                'success' => true,
                'message' => 'Completed'
            ]);
        }
        return response()->json([
            'success'=>false,
            'message' => 'No student selected.'
        ], 400);
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