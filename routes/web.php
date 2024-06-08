<?php

use App\Http\Controllers\Backend\Accounts\Ledger\LedgerController;
use App\Http\Controllers\Backend\Accounts\Master_Ledger\MasterLedgerController;
use App\Http\Controllers\Backend\Accounts\Sub_Ledger\SubLedgerController;
use App\Http\Controllers\Backend\Accounts\Transaction\TransactionController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Student\classController;
use App\Http\Controllers\Backend\Student\SectionController;
use App\Http\Controllers\Backend\Student\StudentController;
use App\Http\Controllers\Backend\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

/*Backend Route*/
Route::get('/admin/login', [AdminController::class, 'login_form'])->name('admin.login');
Route::post('login-functionality',[AdminController::class,'login_functionality'])->name('login.functionality');

Route::group(['middleware'=>'admin'],function(){
    Route::get('/',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::post('/admin/get_dashboard_data',[AdminController::class,'get_data'])->name('admin.dashboard_get_all_data');

    /** Student Management  Route **/
    Route::prefix('admin/student')->group(function(){
        /** Section  Route **/
        Route::prefix('section')->group(function(){
            Route::controller(SectionController::class)->group(function(){
                Route::get('/list','index')->name('admin.student.section.index');
                Route::get('/all_data','all_data')->name('admin.student.section.all_data');
                Route::get('/edit/{id}','edit')->name('admin.student.section.edit');
                Route::post('/update','update')->name('admin.student.section.update');
                Route::post('/store','store')->name('admin.student.section.store');
                Route::post('/delete','delete')->name('admin.student.section.delete');
            });
        });
        /** Class  Route **/
        Route::prefix('class')->group(function(){
            Route::controller(classController::class)->group(function(){
                Route::get('/list','index')->name('admin.student.class.index');
                Route::get('/all_data','all_data')->name('admin.student.class.all_data');
                Route::get('/edit/{id}','edit')->name('admin.student.class.edit');
                Route::post('/update','update')->name('admin.student.class.update');
                Route::post('/store','store')->name('admin.student.class.store');
                Route::post('/delete','delete')->name('admin.student.class.delete');
            });
        });
        /** Student  Route **/
        Route::controller(StudentController::class)->group(function(){
            Route::get('/create','create')->name('admin.student.create');
            Route::post('/store','store')->name('admin.student.store');
            Route::get('/all_data','all_data')->name('admin.student.all_data');
            Route::get('/list','index')->name('admin.student.index');
            Route::get('/edit/{id}','edit')->name('admin.student.edit');
            Route::post('/update/{id}','update')->name('admin.student.update');
            Route::post('/delete','delete')->name('admin.student.delete');
            Route::get('/view/{id}','view')->name('admin.student.view');
        });
    });
     /** Teacher Management  Route **/
    Route::prefix('admin/teacher')->group(function(){
        Route::controller(TeacherController::class)->group(function(){
            Route::get('/create','create')->name('admin.teacher.create');
            Route::post('/store','store')->name('admin.teacher.store');
            Route::get('/list','index')->name('admin.teacher.index');
            Route::get('/all_data','all_data')->name('admin.teacher.all_data');
            Route::get('/edit/{id}','edit')->name('admin.teacher.edit');
            Route::post('/update/{id}','update')->name('admin.teacher.update');
            Route::post('/delete','delete')->name('admin.teacher.delete');
            Route::get('/view/{id}','view')->name('admin.teacher.view');
        });
    });
    /** Accounts Management  Route **/
    Route::prefix('admin/accounts')->group(function(){

        /** Master Ledger Route **/
        Route::prefix('master_ledger')->group(function(){
            Route::controller(MasterLedgerController::class)->group(function(){
                Route::get('/list','index')->name('admin.master_ledger.index');
                Route::get('/get_all_data','get_all_data')->name('admin.master_ledger.all_data');
                Route::get('/edit/{id}','edit')->name('admin.master_ledger.edit');
                Route::post('/update','update')->name('admin.master_ledger.update');
                Route::post('/store','store')->name('admin.master_ledger.store');
                Route::post('/delete','delete')->name('admin.master_ledger.delete');
            });
        });
        /**Ledger Route **/
        Route::prefix('ledger')->group(function(){
            Route::controller(LedgerController::class)->group(function(){
                Route::get('/list','index')->name('admin.ledger.index');
                Route::get('/get_all_data','get_all_data')->name('admin.ledger.all_data');
                Route::get('/edit/{id}','edit')->name('admin.ledger.edit');
                Route::post('/store','store')->name('admin.ledger.store');
                Route::post('/update','update')->name('admin.ledger.update');
                Route::post('/delete','delete')->name('admin.ledger.delete');
            });
        });
        /**Sub Ledger Route **/
        Route::prefix('sub_ledger')->group(function(){
            Route::controller(SubLedgerController::class)->group(function(){
                Route::get('/list','index')->name('admin.sub_ledger.index');
                Route::get('/get_all_data','get_all_data')->name('admin.sub_ledger.all_data');
                Route::get('/edit/{id}','edit')->name('admin.sub_ledger.edit');
                Route::post('/store','store')->name('admin.sub_ledger.store');
                Route::post('/update','update')->name('admin.sub_ledger.update');
                Route::post('/delete','delete')->name('admin.sub_ledger.delete');
                /*get sub ledger from ledger id*/
                Route::get('/get/{id}','get_sub_ledger')->name('admin.sub_ledger.get_sub_ledger');
            });
        });
        /*Transaction Route*/
        Route::prefix('transaction')->group(function(){
            Route::controller(TransactionController::class)->group(function(){
                Route::get('/list','index')->name('admin.transaction.index');
                Route::post('/store','store')->name('admin.transaction.store');
            });
        });
    });
});
