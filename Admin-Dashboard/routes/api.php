<?php

use App\Http\Controllers\Apis\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'products'],function() {
    Route::get('/',[ProductController::class,'products']);
    Route::get('/create',[ProductController::class,'create']);
    Route::post('/store',[ProductController::class,'store']);
    Route::get('/edit/{id}',[ProductController::class,'edit']);
    Route::put('/update/{id}',[ProductController::class,'update']);
    Route::delete('/delete/{id}',[ProductController::class,'delete']);
});



