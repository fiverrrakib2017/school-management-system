<?php
namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student;
use App\Models\Student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
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
}
