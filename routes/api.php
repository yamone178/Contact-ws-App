<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ContactApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function (){
    Route::post('/register',[AuthApiController::class,'register'])->name('api-auth.register');
    Route::post('/login',[AuthApiController::class,'login'])->name('api-auth.login');


    Route::middleware('auth:sanctum')->group(function (){
        Route::post('logout',[AuthApiController::class,'logout'])->name('api-auth.logout');
        Route::apiResource('contacts',ContactApiController::class);
        Route::get('trash',[ContactApiController::class,'trash'])->name('contact.trash');
        Route::post('restore/{id}',[ContactApiController::class,'restore'])->name('contact.restore');
        Route::post('clone/{id}',[ContactApiController::class,'clone'])->name('contact.clone');
        Route::post('/multiple-delete',[ContactApiController::class,'multipleDelete'])->name('contact.multipleDelete');
        Route::post('/multiple-clone',[ContactApiController::class,'multipleClone'])->name('contact.multiple-clone');
        Route::post('/import',[ContactApiController::class,'import'])->name('contact.import');
        Route::get('/export',[ContactApiController::class,'export'])->name('contact.export');


    });
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

