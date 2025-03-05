<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('Frontend.Pages.Home.Home');
});

Route::get('/speech/fullview/{id}',function($id){
    $speech=App\Models\Speech::find($id);
     return view('Frontend.Pages.Speech.FullView',compact('speech'));
})->name('speech.fullview');

Route::get('/banner/fullview/{id}',function($id){
    $banner=App\Models\Banner::find($id);
    return view('Frontend.Pages.Banner.FullView',compact('banner'));
})->name('banner.fullview');

Route::get('/news/fullview/{id}',function(){
    return 'okkkk';
    // return view('Frontend.Pages.News.FullView');
});

/************** Teacher Frontend Route *********************/
Route::get('/teacher/list',function(){
    $teachers=App\Models\Teacher::all();
    return view('Frontend.Pages.Teacher.List',compact('teachers'));
})->name('teacher.list');
Route::get('/teacher/profile/{id}',function($id){
    $teacher = \App\Models\Teacher::findOrFail($id);
    return view('Frontend.Pages.Teacher.Profile',compact('teacher'));
})->name('teacher.fullview');


/************** Student Frontend Route *********************/
Route::get('/student/profile/{id}',function($id){
    $student = \App\Models\Student::with(['currentClass', 'section'])->findOrFail($id);
    return view('Frontend.Pages.Student.Profile', compact('student'));
})->name('student.fullview');

Route::get('/student/list', function (Illuminate\Http\Request $request) {
    $query = \App\Models\Student::with(['currentClass', 'section']);

    /*Class Filter*/
    if ($request->has('class_id') && $request->class_id != '') {
        $query->where('current_class', $request->class_id);
    }

    /* Section Filter*/
    if ($request->has('section_id') && $request->section_id != '') {
        $query->where('section_id', $request->section_id);
    }

    /* Name Filter*/
    if ($request->has('name') && $request->name != '') {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    $students = $query->paginate(10);
    $classes = \App\Models\Student_class::all();
    $sections = \App\Models\Section::all();

    return view('Frontend.Pages.Student.List', compact('students', 'classes', 'sections'));
})->name('student.list');


/************** Facilities Frontend Route *********************/

Route::get('/facilities/fullview/{id}',function($id){
    $facilities = \App\Models\Facilities::findOrFail($id);
    return view('Frontend.Pages.Facilities.Fullview', compact('facilities'));
})->name('facilities.fullview');
