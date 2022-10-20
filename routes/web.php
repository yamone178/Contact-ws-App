<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/contact/export',[\App\Http\Controllers\ContactController::class,'import'])->name('contact.import');
Route::get('/contact/export',[\App\Http\Controllers\ContactController::class,'export'])->name('contact.export');
Route::resource('contact',\App\Http\Controllers\ContactController::class);
Route::post('/contact/multiple-delete',[\App\Http\Controllers\ContactController::class,'multipleDelete'])->name('contact.multipleDelete');
