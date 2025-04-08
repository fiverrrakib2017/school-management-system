<?php
namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Student_exam;
use App\Models\Student_exam_routine;
use App\Models\Student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{

    /**************************Admit CARD MANAGEMENT**************************************************/
    public function index()
    {
        $student=Student::first();
        return view('Backend.Pages.Student.Card.Card_template',compact('student'));
    }
    public function admid_card_template()
    {
        $student=Student::first();
        return view('Backend.Pages.Student.Card.Admit.Card_template',compact('student'));
    }
    public function admid_card_generate()
    {
        $sections= Section::latest()->get();
        $subjects=Student_subject::latest()->get();
        $students=Student::latest()->get();
        return view('Backend.Pages.Student.Card.Admit.Card_generate',compact('students','sections','subjects'));
    }
    public function admid_card_print($exam_id,$class_id, $section_id = null) {
        $exam = Student_exam::find($exam_id);
        $query = Student::with(['currentClass', 'section'])
                        ->where('current_class', '=', $class_id);
        if (!is_null($section_id)) {
            $query->where('section_id', '=', $section_id);
        }
        $students = $query->get();
        if($students->isEmpty()){
            return redirect()->back()->with('error', 'No students found for the selected class and section.');
        }
        return view('Backend.Pages.Student.Card.Admit.Print', compact('students', 'exam_id','exam'));
    }

    /**************************ID CARD MANAGEMENT**************************************************/
    public function id_card_generate(){
        $sections= Section::latest()->get();
        $students=Student::latest()->get();
        return view('Backend.Pages.Student.Card.id_card',compact('students','sections'));
    }
    public function id_card_print($class_id, $section_id = null) {
        $query = Student::with(['currentClass', 'section'])->where('current_class', '=', $class_id);

        if (!is_null($section_id)) {
            $query->where('section_id', '=', $section_id);
        }

        $classes = $query->get();

        return view('Backend.Pages.Student.Card.id_card_print', compact('classes'));
    }
    /************************** Seat Plan MANAGEMENT**************************************************/
    public function seat_plan_generate(){
        $sections= Section::latest()->get();
        $students=Student::latest()->get();
        return view('Backend.Pages.Student.Card.Seat.index',compact('students','sections'));
    }
    public function seat_plan_print($exam_id, $student_ids) {

        $exam = Student_exam::find($exam_id);

        $student_ids = explode(',', $student_ids);
        $students = Student::with(['currentClass', 'section'])
                        ->whereIn('id', $student_ids)
                        ->get();


        return view('Backend.Pages.Student.Card.Seat.print', compact('exam', 'students'));
    }


}
