<?php

namespace App\Http\Controllers\Backend\Student;
use App\Http\Controllers\Controller;
use App\Models\Customer_ticket;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Student_exam;
use App\Models\Student_exam_result;
use App\Models\Student_exam_routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Exam_result_controller extends Controller
{

    public function create_result()
    {
        Student_exam::all();
        Student_class::all();
        Student::all();
        return view('Backend.Pages.Student.Exam.Create_result');
    }
    public function result_report()
    {
        return view('Backend.Pages.Student.Exam.Result');
    }

    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];

        $query = Student_exam_result::with(['exam','student','subject'])->when($search, function ($query) use ($search) {
            $query->where('total_marks', 'like', "%$search%")
                //   ->orWhereHas('exam', function ($query) use ($search) {
                //       $query->where('fullname', 'like', "%$search%")
                //             ->orWhere('phone_number', 'like', "%$search%");
                //   })
                  ->orWhereHas('student', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('exam', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('subject', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%");
                  });
        }) ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection)
        ->paginate($request->length);


        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $query->total(),
            'recordsFiltered' => $query->total(),
            'data' => $query->items(),
        ]);
    }
    public function result_store(Request $request)
    {
        
        // $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('H:i:s');
        // $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('H:i:s');
        /*Validate the form data*/
        $this->validateForm($request);
        $object = new Student_exam_result();
        $object->exam_id  = $request->exam_id ;
        $object->student_id = $request->student_id;
        $object->subject_id = $request->subject_id;
        $object->marks_obtained = $request->marks_obtained;
        $object->total_marks = $request->total_marks;
        $object->grade = $request->grade;
        $object->remarks = $request->remarks;

        /* Save to the database table*/
        $object->save();
        return response()->json([
            'success' => true,
            'message' => 'Added successfully!'
        ]);
    }


    public function delete(Request $request)
    {
        $object = Student_exam_result::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Not found.'], 404);
        }


        /* Delete it From Database Table */
        $object->delete();

        return response()->json(['success' =>true, 'data'=>$object, 'message'=> 'Deleted successfully.']);
    }
    public function edit($id)
    {
        $data = Student_exam_result::find($id);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
            exit;
        } else {
            return response()->json(['success' => false, 'message' => 'Not found.']);
        }
    }


    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $object = Student_exam_result::findOrFail($id);
        $object->exam_id  = $request->exam_id ;
        $object->student_id = $request->student_id;
        $object->subject_id = $request->subject_id;
        $object->marks_obtained = $request->marks_obtained;
        $object->total_marks = $request->total_marks;
        $object->grade = $request->grade;
        $object->remarks = $request->remarks;
        $object->update();

        return response()->json([
            'success' => true,
            'message' => 'Update successfully!'
        ]);
    }
    public function get_exam_result(Request $request){

        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $data = Student_exam_result::with(['exam','student','subject'])->where(['exam_id'=>$exam_id, 'class_id'=>$class_id])->get();
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
            exit;
        } else {
            return response()->json(['success' => false, 'message' => 'Not found.']);
        }
    }
    private function validateForm($request)
    {
        /*Validate the form data*/
        $rules=[
            'exam_id' => 'required|exists:student_exams,id',
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:student_subjects,id',
            'marks_obtained' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'total_marks' => 'required|integer',
            'grade' => 'required|string|max:255'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    }
}
