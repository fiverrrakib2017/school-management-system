<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('Frontend.Pages.Home.Home');
});

Route::get('/speech/fullview/{id}',function($id){
    $speech=App\Models\Speech::find($id);
     return view('Frontend.Pages.Speech.FullView',compact('speech'));
})->name('speech.fullview');

Route::get('/banner/fullview/{id}',function(){
    return 'okkkk';
    // return view('Frontend.Pages.Banner.FullView');
});

Route::get('/news/fullview/{id}',function(){
    return 'okkkk';
    // return view('Frontend.Pages.News.FullView');
});

/************** Teacher Frontend Route *********************/
Route::get('/teacher/fullview/{id}',function(){
    return 'okkkk';
    // return view('Frontend.Pages.Teacher.FullView');
})->name('teacher.fullview');


/************** Student Frontend Route *********************/
Route::get('/student/fullview/{id}',function($id){
    return $id; // This will return the id of the student
    // return view('Frontend.Pages.Student.FullView');
})->name('student.fullview');

Route::get('/student/list',function(){
    return view('Frontend.Pages.Student.List');
})->name('student.list');
