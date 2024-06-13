<?php

use App\Http\Controllers\Backend\Accounts\Ledger\LedgerController;
use App\Http\Controllers\Backend\Accounts\Master_Ledger\MasterLedgerController;
use App\Http\Controllers\Backend\Accounts\Sub_Ledger\SubLedgerController;
use App\Http\Controllers\Backend\Accounts\Transaction\TransactionController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Customer\CustomerController;
use App\Http\Controllers\Backend\Customer\InvoiceController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\SubCateogryController;
use App\Http\Controllers\Backend\Product\ColorController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\TempImageController;
use App\Http\Controllers\Backend\Product\ChildCategoryController;
use App\Http\Controllers\Backend\Product\SizeController;
use App\Http\Controllers\Backend\Product\StockController;
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
    /** Customer  Route **/
    Route::prefix('admin/customer')->group(function(){
        Route::get('/list',[CustomerController::class,'index'])->name('admin.customer.index');

        Route::get('/all-data',[CustomerController::class,'get_all_data'])->name('admin.customer.get_all_data');

        Route::get('/create',[CustomerController::class,'create'])->name('admin.customer.create');

        Route::get('/edit/{id}',[CustomerController::class,'edit'])->name('admin.customer.edit');

        Route::get('/view/{id}',[CustomerController::class,'view'])->name('admin.customer.view');

        Route::post('/delete',[CustomerController::class,'delete'])->name('admin.customer.delete');

        Route::post('/store',[CustomerController::class,'store'])->name('admin.customer.store');

        Route::post('/update/{id}',[CustomerController::class,'update'])->name('admin.customer.update');

         /** Customer Invoice  Route **/
         Route::get('/invoice/create',[InvoiceController::class,'create_invoice'])->name('admin.customer.invoice.create_invoice');

         Route::get('/invoice/get_all_data',[InvoiceController::class,'show_invoice_data'])->name('admin.customer.invoice.show_invoice_data');

         /*Seach Invoice Page Product Data*/
         Route::post('/invoice/search_data',[InvoiceController::class,'search_product_data'])->name('admin.customer.invoice.search_product_data');

         Route::get('/invoice/show',[InvoiceController::class,'show_invoice'])->name('admin.customer.invoice.show_invoice');

         Route::post('/invoice/pay',[InvoiceController::class,'pay_due_amount'])->name('admin.customer.invoice.pay_due_amount');

        Route::post('/invoice/store',[InvoiceController::class,'store_invoice'])->name('admin.customer.invoice.store_invoice');

        Route::get('/invoice/view/{id}',[InvoiceController::class,'view_invoice'])->name('admin.customer.invoice.view_invoice');

         Route::get('/invoice/edit/{id}',[InvoiceController::class,'edit_invoice'])->name('admin.customer.invoice.edit_invoice');

         Route::post('/invoice/update',[InvoiceController::class,'update_invoice'])->name('admin.customer.invoice.update_invoice');

         Route::post('/invoice/delete',[InvoiceController::class,'delete_invoice'])->name('admin.customer.invoice.delete_invoice');
    });
    /*Product Route*/
    Route::prefix('admin/product')->group(function(){
        /*Brand Route*/
        Route::get('brand',[BrandController::class,'index'])->name('admin.brand.index');
        Route::get('brand/create',[BrandController::class,'create'])->name('admin.brand.create');
        Route::post('brand/store',[BrandController::class,'store'])->name('admin.brand.store');
        Route::get('/brand/delete/{id}',[BrandController::class,'delete'])->name('admin.brand.delete');
        Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('admin.brand.edit');
        Route::post('/brand/update',[BrandController::class,'update'])->name('admin.brand.update');


        /*Category Route*/
        Route::get('/category',[CategoryController::class,'index'])->name('admin.category.index');
        Route::get('/category/create',[CategoryController::class,'create'])->name('admin.category.create');
        Route::post('/category/store',[CategoryController::class,'store'])->name('admin.category.store');
        Route::post('/category/delete',[CategoryController::class,'delete'])->name('admin.category.delete');
        Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
        Route::post('/category/update',[CategoryController::class,'update'])->name('admin.category.update');


        /* Sub Category Route*/
        Route::get('/sub-category',[SubCateogryController::class,'index'])->name('admin.subcategory.index');
        Route::post('/sub-category/store',[SubCateogryController::class,'store'])->name('admin.subcategory.store');
        Route::get('/sub-category/edit/{id}',[SubCateogryController::class,'edit'])->name('admin.subcategory.edit');
        Route::post('/sub-category/delete',[SubCateogryController::class,'delete'])->name('admin.subcategory.delete');
        Route::post('/sub-category/update/{id}',[SubCateogryController::class,'update'])->name('admin.subcategory.update');
        /*Get Sub Category*/
        Route::get('/get-sub_category/{id}',[SubCateogryController::class,'get_sub_category']);


        /* Child Category Route*/
        Route::get('/child-category',[ChildCategoryController::class,'index'])->name('admin.childcategory.index');
        Route::post('/child-category/store',[ChildCategoryController::class,'store'])->name('admin.childcategory.store');
        Route::get('/child-category/edit/{id}',[ChildCategoryController::class,'edit'])->name('admin.childcategory.edit');
        Route::post('/child-category/delete',[ChildCategoryController::class,'delete'])->name('admin.childcategory.delete');
        Route::post('/child-category/update/{id}',[ChildCategoryController::class,'update'])->name('admin.childcategory.update');

        /*Get child Category*/
        Route::get('/get-child_category/{id}',[ChildCategoryController::class,'get_child_category']);

         /** Product Color Mangement Route **/
         Route::get('/color',[ColorController::class,'index'])->name('admin.product.color.index');
         Route::get('/color/get_all_data',[ColorController::class,'get_all_data'])->name('admin.product.color.all_data');
         Route::post('/color/store',[ColorController::class,'store'])->name('admin.product.color.store');
         Route::get('/color/edit/{id}',[ColorController::class,'edit'])->name('admin.product.color.edit');
         Route::post('/color/update',[ColorController::class,'update'])->name('admin.product.color.update');
         Route::post('/color/delete',[ColorController::class,'delete'])->name('admin.product.color.delete');

         /**Product Size Mangement Route **/
         Route::get('/size',[SizeController::class,'index'])->name('admin.product.size.index');
         Route::get('/size/get_all_data',[SizeController::class,'get_all_data'])->name('admin.product.size.all_data');
         Route::post('/size/store',[SizeController::class,'store'])->name('admin.product.size.store');
         Route::get('/size/edit/{id}',[SizeController::class,'edit'])->name('admin.product.size.edit');
         Route::post('/size/update',[SizeController::class,'update'])->name('admin.product.size.update');
         Route::post('/size/delete',[SizeController::class,'delete'])->name('admin.product.size.delete');

          /* Product Route*/
        Route::get('/all',[ProductController::class,'index'])->name('admin.products.index');
        Route::get('/get_product/{id}',[ProductController::class,'get_product'])->name('admin.products.get_product');
        Route::get('/create',[ProductController::class,'create'])->name('admin.products.create');
        Route::post('/update',[ProductController::class,'product_update'])->name('admin.product.update');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('admin.products.edit');

         /* Product Image*/
         Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('tempimage.create');
         Route::post('/photo/update',[ProductController::class,'photo_update'])->name('admin.product.photo.update');
         Route::post('/delete/photo',[ProductController::class,'delete_photo'])->name('admin.product.delete.photo');

         /* Product Store*/
         Route::post('/store',[ProductController::class,'store'])->name('admin.products.store');
         Route::post('/delete',[ProductController::class,'delete'])->name('admin.products.delete');
        /* Stock Route*/
         Route::get('/stock',[StockController::class,'index'])->name('admin.product.stock.index');
    });
});
