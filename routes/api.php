<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ContactApiController;
use App\Http\Controllers\StoreContactApiController;

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

    //auth
    Route::post('/register',[AuthApiController::class,'register'])->name('api-auth.register');
    Route::post('/login',[AuthApiController::class,'login'])->name('api-auth.login');


    Route::middleware('auth:sanctum')->group(function (){
        Route::post('logout',[AuthApiController::class,'logout'])->name('api-auth.logout');
        Route::post("/logout-all",[AuthApiController::class,'logoutAll'])->name('api.logout-all');

        Route::apiResource('label',\App\Http\Controllers\LabelApiController::class);

        Route::apiResource('contact',ContactApiController::class);

        Route::get('trash',[ContactApiController::class,'trash'])->name('api-contact.trash');
        Route::post('restore/{id}',[ContactApiController::class,'restore'])->name('api-contact.restore');
        Route::post('clone/{id}',[ContactApiController::class,'clone'])->name('contact.clone');
        Route::post('/multiple-delete',[ContactApiController::class,'multipleDelete'])->name('api-contact.multipleDelete');
        Route::post('/multiple-clone',[ContactApiController::class,'multipleClone'])->name('api-contact.multiple-clone');
        Route::apiResource('contactStore',StoreContactApiController::class);
//        Route::get('/noti',[StoreContactApiController::class,'noti'])->name('contact.noti');
        Route::post('/accept-contact/{id}', [StoreContactApiController::class,'acceptContact'])->name('api-contact.acceptContact');
        Route::post('/contactStore/{id}',[StoreContactApiController::class,'addToContactStore'])->name('api-contact.addToStore');
        Route::post('/decline-contact/{id}',[StoreContactApiController::class,'declineContact'])->name('api-contact.declineContact');


        //laravel excel
//        Route::post('/import',[ContactApiController::class,'import'])->name('contact.import');
//      Route::get('/export',[ContactApiController::class,'export'])->name('contact.export');


    });
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

