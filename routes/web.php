<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ControllerCostumer_Report;
use App\Http\Controllers\ControllerInvoices_Report;
use App\Http\Controllers\rolecontroller;
use App\Http\Controllers\usercontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesAttachementsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionController;
use App\Models\invoices_details;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register',function(){
    return view('auth.register');
});

// Route::get('/register',[login::class,'register'])->name('inscription');

Auth::routes(['register' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('idsection/{id}',[InvoicesController::class , 'getproducts'])->name('bb');

Route::get('/invoicesdetails/{id}',[InvoicesDetailsController::class , 'details']);

Route::get('/products',[ProductsController::class, 'index'])->name('product');

Route::delete('destroyproduct',[ProductsController::class , 'destroy'])->name('deleted');

Route::post('/store',[ProductsController::class, 'store'])->name('store');

Route::get('create',[InvoicesController::class,'create'])->name('create');

Route::resource('invoices',InvoicesController::class);

Route::resource('archive',ArchiveController::class);

Route::delete('/delete_invoice',[InvoicesController::class , 'destroy'])->name('delete_invoice');

Route::get('/editinvoice/{id}' , [InvoicesController::class , 'editenvoice']);

Route::get('/show_invoice/{id}',[InvoicesController::class , 'show_invoice']);

Route::get('/print_invoice/{id}',[InvoicesController::class , 'printinvoice']);

Route::patch('invoices/update' , [InvoicesController::class , 'update']);

Route::post('status_update/{id}',[InvoicesController::class , 'show'])->name('status_update');

Route::get('/view_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class , 'view']);

Route::get('/download/{invoice_number}/{file_name}',[InvoicesDetailsController::class , 'download']);

Route::post('delete_file',[InvoicesDetailsController::class , 'delete'])->name('delete_file');

Route::post('/creations',[InvoicesController::class,'store'])->name('storeinvoices');

Route::post('addattachement',[InvoicesDetailsController::class , 'add'])->name('add_attachement');

Route::get('nonpaid',[InvoicesController::class , 'nonpaid']);
Route::get('paid',[InvoicesController::class , 'paid']);
Route::get('partial',[InvoicesController::class , 'partial']);

Route::get('archive',[ArchiveController::class , 'index']);

Route::get('delete/{id}',[InvoicesController::class , 'delete']);

Route::resource('section', SectionController::class);

Route::patch('updateproduct',[ProductsController::class , 'update'])->name('updateproduct');

Route::patch('update',[SectionController::class ,'update'])->name('update');

Route::delete('destroy',[SectionController::class ,'destroy'])->name('destroy');

Route::get('export_invoices',[InvoicesController::class , 'export']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',rolecontroller::class);
    Route::resource('users',usercontroller::class);
    });

Route::get('invoice_report',[ControllerInvoices_Report::class,'index']);

Route::post('search_invoices',[ControllerInvoices_Report::class , 'search']);

Route::get('costumer',[ControllerCostumer_Report::class , 'index']);

Route::get('/{page}',[AdminController::class,'index']);