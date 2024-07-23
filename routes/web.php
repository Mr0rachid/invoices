<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
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

// Route::get('/register',[login::class,'register'])->name('inscription');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('invoices',InvoicesController::class);

Route::resource('section', SectionController::class);

Route::patch('update',[SectionController::class ,'update'])->name('update');

Route::delete('destroy',[SectionController::class ,'destroy'])->name('destroy');

Route::get('/{page}',[AdminController::class,'index']);