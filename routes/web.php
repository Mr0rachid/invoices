<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesAttachementsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionController;

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

Route::get('/editinvoice/{id}' , [InvoicesController::class , 'editenvoice']);

Route::patch('invoices/update' , [InvoicesController::class , 'update']);

Route::get('/view_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class , 'view']);

Route::get('/download/{invoice_number}/{file_name}',[InvoicesDetailsController::class , 'download']);

Route::post('delete_file',[InvoicesDetailsController::class , 'delete'])->name('delete_file');

Route::post('/creations',[InvoicesController::class,'store'])->name('storeinvoices');

Route::post('addattachement',[InvoicesDetailsController::class , 'add'])->name('add_attachement');

Route::resource('section', SectionController::class);

Route::patch('updateproduct',[ProductsController::class , 'update'])->name('updateproduct');

Route::patch('update',[SectionController::class ,'update'])->name('update');

Route::delete('destroy',[SectionController::class ,'destroy'])->name('destroy');

Route::get('/{page}',[AdminController::class,'index']);