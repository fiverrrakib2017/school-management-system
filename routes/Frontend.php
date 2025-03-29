<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Frontend.Pages.Home.Home');
});

Route::get('/speech/fullview/{id}', function ($id) {
    $speech = App\Models\Speech::find($id);
    return view('Frontend.Pages.Speech.FullView', compact('speech'));
})->name('speech.fullview');

Route::get('/banner/fullview/{id}', function ($id) {
    $banner = App\Models\Banner::find($id);
    return view('Frontend.Pages.Banner.FullView', compact('banner'));
})->name('banner.fullview');

Route::get('/news/fullview/{id}', function () {
    return 'okkkk';
    // return view('Frontend.Pages.News.FullView');
});

/************** Teacher Frontend Route *********************/
Route::get('/teacher/list', function () {
    $teachers = App\Models\Teacher::all();
    return view('Frontend.Pages.Teacher.List', compact('teachers'));
})->name('teacher.list');

Route::get('/teacher/profile/{id}', function ($id) {
    $teacher = \App\Models\Teacher::findOrFail($id);
    return view('Frontend.Pages.Teacher.Profile', compact('teacher'));
})->name('teacher.fullview');

/************** Student Frontend Route *********************/
Route::get('/student/profile/{id}', function ($id) {
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

Route::get('/facilities/fullview/{id}', function ($id) {
    $facilities = \App\Models\Facilities::findOrFail($id);
    return view('Frontend.Pages.Facilities.Fullview', compact('facilities'));
})->name('facilities.fullview');

/************** Recent News Frontend Route *********************/
Route::get('/recent/news/list', function () {
    $news = \App\Models\Notice::where('post_type', '2')->latest()->paginate(5);
    return view('Frontend.Pages.News.Recent', compact('news'));
})->name('recent.news.all');

Route::get('/recent/news/view/{id}', function ($id) {
    $news = \App\Models\Notice::find($id);
    return view('Frontend.Pages.News.View', compact('news'));
})->name('recent.news.view');
/************** Photo Gallery Frontend Route *********************/
Route::get('/photo/gallery', function () {
    return view('Frontend.Pages.Gallery.Show');
})->name('photo.gallery.all');

/************** General Notice Frontend Route *********************/
Route::get('/notice/general', function () {
    $data = \App\Models\Notice::where('post_type', '1')->where('notice_type', '1')->latest()->paginate(5);
    return view('Frontend.Pages.Notice.General.index', compact('data'));
})->name('notice.general.all');

Route::get('/notice/general/view/{id}', function ($id) {
    $news = \App\Models\Notice::find($id);
    return view('Frontend.Pages.Notice.General.view', compact('news'));
})->name('notice.general.view');

/************** Important Notice Frontend Route *********************/
Route::get('/notice/important', function () {
    $data = \App\Models\Notice::where('post_type', '1')->where('notice_type', '2')->latest()->paginate(5);
    return view('Frontend.Pages.Notice.Important.index', compact('data'));
})->name('notice.important.all');

Route::get('/notice/important/view/{id}', function ($id) {
    $news = \App\Models\Notice::find($id);
    return view('Frontend.Pages.Notice.Important.view', compact('news'));
})->name('notice.important.view');

/************** Exam Corners Frontend Route *********************/
Route::get('/exam/routine', function () {
    $data = \App\Models\Exam_cornar::latest()->paginate(5);
    return view('Frontend.Pages.Corner.Exam', compact('data'));
})->name('exam.routine');
/************** Teacher Corners Frontend Route *********************/
Route::get('/teacher/corners', function () {
    $data = App\Models\Teacher_corner::with(['class', 'section', 'subject', 'teacher'])
        ->latest()
        ->paginate(5);
    return view('Frontend.Pages.Corner.Teacher', compact('data'));
})->name('teacher.corners');
/************** Contract Frontend Route *********************/
Route::get('/contract', function () {
    $data = App\Models\Contract::latest()->paginate(5);
    return view('Frontend.Pages.Contract.index', compact('data'));
})->name('contract');
/************** Search Result Frontend Route *********************/
Route::get('/result/search', function () {
    $classes = \App\Models\Student_class::all();
    $sections = \App\Models\Section::all();
    $students = \App\Models\Student::with(['currentClass', 'section'])
        ->latest()
        ->paginate(10);
    return view('Frontend.Pages.Result.Search', compact('classes', 'sections', 'students'));
})->name('result.search');

Route::post('/get_exam_result', function (Illuminate\Http\Request $request) {
    $query = \App\Models\Student_exam_result::query();
    if ($request->class_id) {
        $query->where('class_id', $request->class_id);
    }

    if ($request->exam_id) {
        $query->where('exam_id', $request->exam_id);
    }

    if ($request->student_id) {
        $query->where('student_id', $request->student_id);
    }
    if ($request->roll_no) {
        $query->whereHas('student', function ($q) use ($request) {
            $q->where('roll_no', $request->roll_no);
        });
    }

    /* Load related models*/
    $data = $query->with(['exam', 'student', 'subject', 'class', 'section'])->get();

    /*Check if data exists*/
    if ($data->isNotEmpty()) {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'No results found.',
    ]);
})->name('student.exam.result.get_result');

Route::get('/result/print/{exam_id}/{student_id}', function ($exam_id, $student_id) {
    $student = \App\Models\Student::find($student_id);
    $exam = \App\Models\Student_exam::find($exam_id);
    return view('Backend.Pages.Student.Exam.Result.Print', compact('student', 'exam_id', 'exam'));
})->name('student.result.print');
