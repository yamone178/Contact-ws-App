<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StoreController;

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

Route::resource('contact',ContactController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/trash',[ContactController::class,'trash'])->name('contact.trash');
Route::post('/restore/{id}',[ContactController::class,'restore'])->name('contact.restore');
Route::post('/multiple-delete',[ContactController::class,'multipleDelete'])->name('contact.multipleDelete');
Route::post('/clone/{id}',[ContactController::class,'clone'])->name('contact.clone');
Route::post('/multiple-clone',[ContactController::class,'multipleClone'])->name('contact.multiple-clone');
Route::post('/import',[ContactController::class,'import'])->name('contact.import');
Route::get('/export',[ContactController::class,'export'])->name('contact.export');
Route::resource('contactStore',StoreController::class);
Route::get('/noti',[StoreController::class,'noti'])->name('contact.noti');
Route::post('/accept-contact/{id}', [StoreController::class,'acceptContact'])->name('contact.acceptContact');
Route::post('/contactStore/{id}',[StoreController::class,'addToContactStore'])->name('contact.addToStore');
Route::post('/decline-contact/{id}',[StoreController::class,'declineContact'])->name('contact.declineContact');
