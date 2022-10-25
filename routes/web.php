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

Route::resource('contact',\App\Http\Controllers\ContactController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/trash',[\App\Http\Controllers\ContactController::class,'trash'])->name('contact.trash');
Route::post('/restore/{id}',[\App\Http\Controllers\ContactController::class,'restore'])->name('contact.restore');
Route::post('/multiple-delete',[\App\Http\Controllers\ContactController::class,'multipleDelete'])->name('contact.multipleDelete');
Route::post('/clone/{id}',[\App\Http\Controllers\ContactController::class,'clone'])->name('contact.clone');
Route::post('/multiple-clone',[\App\Http\Controllers\ContactController::class,'multipleClone'])->name('contact.multiple-clone');
Route::post('/import',[\App\Http\Controllers\ContactController::class,'import'])->name('contact.import');
Route::get('/export',[\App\Http\Controllers\ContactController::class,'export'])->name('contact.export');

