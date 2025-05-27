<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student_class;
use App\Models\Student_class_routine;
use App\Models\Student_subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassRoutine_controller extends Controller
{
    public function index(){
       $classes = Student_class::latest()->get();
       $subjects= Student_subject::latest()->get();
       $teachers=Teacher::latest()->get();
       $sections= Section::latest()->get();
        return view('Backend.Pages.Student.Routine.index',compact('classes','subjects', 'teachers', 'sections'));
    }

    public function store(Request $request){
        /*Validate the incoming request data*/
         $request->validate([
            'class_id'              => 'required|integer',
            'section_id'            => 'required|integer',
            'routines'              => 'required|array',
            'routines.*.subject_id' => 'required|integer',
            'routines.*.teacher_id' => 'required|integer',
            'routines.*.day'        => 'required|string',
            'routines.*.start_time' => 'required',
            'routines.*.end_time'   => 'required',
        ]);
        /*delete previous_routine*/
        Student_class_routine::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->delete();
        /*Store The class Routine*/
        foreach($request->routines  as $item) {
            $object                 = new Student_class_routine();
            $object->class_id       = $request->class_id;
            $object->section_id     = $request->section_id;
            $object->subject_id     = $item['subject_id'];
            $object->teacher_id     = $item['teacher_id'];
            $object->day            = $item['day'];
            $object->start_time     = $item['start_time'];
            $object->end_time       = $item['end_time'];
            $object->save();
        }
        /*Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Successfully Completed.',
            'code' => 200,
        ]);
    }


    public function get_class_routine(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
            'section_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $query = Student_class_routine::query();
        /* Apply filter class_id */
        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }
        /* Apply filter section_id */
        if ($request->section_id) {
            $query->where('section_id', $request->section_id);
        }

        /* Load related models*/
        $data = $query->with(['class', 'subject', 'teacher'])->get();

        /*Check if data exists*/
        return response()->json([
            'success' => true,
            'code'=>200,
            'data' => $data,
            'subjects' => Student_subject::where('class_id', $request->class_id)->where('section_id',$request->section_id)->get(),
            'teachers' => Teacher::latest()->get(),
        ]);
    }

    public function print(Request $request){
        $class_id = $request->input('class_id');

        $routines = Student_class_routine::where('class_id', $class_id)->get();

        $view = view('Backend.Pages.Student.Routine.print_routine', compact('routines'))->render();

        return response()->json($view);
    }
}
