<?php

use App\Http\Controllers\Backend\Accounts\Ledger\LedgerController;
use App\Http\Controllers\Backend\Accounts\Master_Ledger\MasterLedgerController;
use App\Http\Controllers\Backend\Accounts\Sub_Ledger\SubLedgerController;
use App\Http\Controllers\Backend\Accounts\Transaction\TransactionController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Customer\CustomerController;
use App\Http\Controllers\Backend\Supplier\Supplier_invoiceController;
use App\Http\Controllers\Backend\Supplier\Supplier_returnController;
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
use App\Http\Controllers\Backend\Supplier\SupplierController;
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
    /** Customer Route **/
    Route::prefix('admin/customer')->group(function() {
        Route::controller(CustomerController::class)->group(function() {
            Route::get('/list', 'index')->name('admin.customer.index');
            Route::get('/all-data', 'get_all_data')->name('admin.customer.get_all_data');
            Route::get('/create', 'create')->name('admin.customer.create');
            Route::get('/edit/{id}', 'edit')->name('admin.customer.edit');
            Route::get('/view/{id}', 'view')->name('admin.customer.view');
            Route::post('/delete', 'delete')->name('admin.customer.delete');
            Route::post('/store', 'store')->name('admin.customer.store');
            Route::post('/update/{id}', 'update')->name('admin.customer.update');
        });

        /** Customer Invoice Route **/
        Route::prefix('invoice')->controller(InvoiceController::class)->group(function() {
            Route::get('/create', 'create_invoice')->name('admin.customer.invoice.create_invoice');
            Route::get('/get_all_data', 'show_invoice_data')->name('admin.customer.invoice.show_invoice_data');
            Route::post('/search_data', 'search_product_data')->name('admin.customer.invoice.search_product_data');
            Route::get('/show', 'show_invoice')->name('admin.customer.invoice.show_invoice');
            Route::post('/pay', 'pay_due_amount')->name('admin.customer.invoice.pay_due_amount');
            Route::post('/store', 'store_invoice')->name('admin.customer.invoice.store_invoice');
            Route::get('/view/{id}', 'view_invoice')->name('admin.customer.invoice.view_invoice');
            Route::get('/edit/{id}', 'edit_invoice')->name('admin.customer.invoice.edit_invoice');
            Route::post('/update', 'update_invoice')->name('admin.customer.invoice.update_invoice');
            Route::post('/delete', 'delete_invoice')->name('admin.customer.invoice.delete_invoice');
        });
    });
    /** Supplier Route **/
    Route::prefix('admin/supplier')->group(function(){
        Route::controller(SupplierController::class)->group(function(){
            Route::get('/list', 'index')->name('admin.supplier.index');
            Route::get('/all-data', 'get_all_data')->name('admin.supplier.get_all_data');
            Route::get('/create', 'create')->name('admin.supplier.create');
            Route::get('/edit/{id}', 'edit')->name('admin.supplier.edit');
            Route::get('/view/{id}', 'view')->name('admin.supplier.view');
            Route::post('/delete', 'delete')->name('admin.supplier.delete');
            Route::post('/store', 'store')->name('admin.supplier.store');
            Route::post('/update/{id}', 'update')->name('admin.supplier.update');
        });
        /** Customer Invoice Route **/
        Route::prefix('invoice')->controller(Supplier_invoiceController::class)->group(function() {
            Route::get('/create', 'create_invoice')->name('admin.supplier.invoice.create_invoice');
            Route::get('/get_all_data', 'show_invoice_data')->name('admin.supplier.invoice.show_invoice_data');
            Route::post('/search_data', 'search_product_data')->name('admin.supplier.invoice.search_product_data');
            Route::get('/show', 'show_invoice')->name('admin.supplier.invoice.show_invoice');
            Route::post('/pay', 'pay_due_amount')->name('admin.supplier.invoice.pay_due_amount');
            Route::post('/store', 'store_invoice')->name('admin.supplier.invoice.store_invoice');
            Route::get('/view/{id}', 'view_invoice')->name('admin.supplier.invoice.view_invoice');
            Route::get('/edit/{id}', 'edit_invoice')->name('admin.supplier.invoice.edit_invoice');
            Route::post('/update', 'update_invoice')->name('admin.supplier.invoice.update_invoice');
            Route::post('/delete', 'delete_invoice')->name('admin.supplier.invoice.delete_invoice');
        });
    });
   
    /* Product Route */
    Route::prefix('admin/product')->group(function() {
        /* Brand Route */
        Route::prefix('brand')->controller(BrandController::class)->group(function() {
            Route::get('/', 'index')->name('admin.brand.index');
            Route::get('/create', 'create')->name('admin.brand.create');
            Route::post('/store', 'store')->name('admin.brand.store');
            Route::get('/delete/{id}', 'delete')->name('admin.brand.delete');
            Route::get('/edit/{id}', 'edit')->name('admin.brand.edit');
            Route::post('/update', 'update')->name('admin.brand.update');
        });

        /* Category Route */
        Route::prefix('category')->controller(CategoryController::class)->group(function() {
            Route::get('/', 'index')->name('admin.category.index');
            Route::get('/create', 'create')->name('admin.category.create');
            Route::post('/store', 'store')->name('admin.category.store');
            Route::post('/delete', 'delete')->name('admin.category.delete');
            Route::get('/edit/{id}', 'edit')->name('admin.category.edit');
            Route::post('/update', 'update')->name('admin.category.update');
        });

        /* Sub Category Route */
        Route::prefix('sub-category')->controller(SubCateogryController::class)->group(function() {
            Route::get('/', 'index')->name('admin.subcategory.index');
            Route::post('/store', 'store')->name('admin.subcategory.store');
            Route::get('/edit/{id}', 'edit')->name('admin.subcategory.edit');
            Route::post('/delete', 'delete')->name('admin.subcategory.delete');
            Route::post('/update/{id}', 'update')->name('admin.subcategory.update');
            Route::get('/get-sub_category/{id}', 'get_sub_category');
        });

        /* Child Category Route */
        Route::prefix('child-category')->controller(ChildCategoryController::class)->group(function() {
            Route::get('/', 'index')->name('admin.childcategory.index');
            Route::post('/store', 'store')->name('admin.childcategory.store');
            Route::get('/edit/{id}', 'edit')->name('admin.childcategory.edit');
            Route::post('/delete', 'delete')->name('admin.childcategory.delete');
            Route::post('/update/{id}', 'update')->name('admin.childcategory.update');
            Route::get('/get-child_category/{id}', 'get_child_category');
        });

        /** Product Color Management Route **/
        Route::prefix('color')->controller(ColorController::class)->group(function() {
            Route::get('/', 'index')->name('admin.product.color.index');
            Route::get('/get_all_data', 'get_all_data')->name('admin.product.color.all_data');
            Route::post('/store', 'store')->name('admin.product.color.store');
            Route::get('/edit/{id}', 'edit')->name('admin.product.color.edit');
            Route::post('/update', 'update')->name('admin.product.color.update');
            Route::post('/delete', 'delete')->name('admin.product.color.delete');
        });

        /** Product Size Management Route **/
        Route::prefix('size')->controller(SizeController::class)->group(function() {
            Route::get('/', 'index')->name('admin.product.size.index');
            Route::get('/get_all_data', 'get_all_data')->name('admin.product.size.all_data');
            Route::post('/store', 'store')->name('admin.product.size.store');
            Route::get('/edit/{id}', 'edit')->name('admin.product.size.edit');
            Route::post('/update', 'update')->name('admin.product.size.update');
            Route::post('/delete', 'delete')->name('admin.product.size.delete');
        });

        /* Product Route */
        Route::controller(ProductController::class)->group(function() {
            Route::get('/all', 'index')->name('admin.products.index');
            Route::get('/get_product/{id}', 'get_product')->name('admin.products.get_product');
            Route::get('/create', 'create')->name('admin.products.create');
            Route::post('/update', 'product_update')->name('admin.product.update');
            Route::get('/edit/{id}', 'edit')->name('admin.products.edit');
            Route::get('/view/{id}', 'view')->name('admin.products.view');
            Route::post('/store', 'store')->name('admin.products.store');
            Route::post('/delete', 'delete')->name('admin.products.delete');
        });

        /* Product Image */
        Route::prefix('photo')->controller(ProductController::class)->group(function() {
            Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('tempimage.create');
            Route::post('/update', 'photo_update')->name('admin.product.photo.update');
            Route::post('/delete', 'delete_photo')->name('admin.product.delete.photo');
        });

        /* Stock Route */
        Route::get('/stock', [StockController::class, 'index'])->name('admin.product.stock.index');
    });



});
