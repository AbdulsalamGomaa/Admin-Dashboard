<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admins\dashboard\DashboardController;
use App\Http\Controllers\admins\dashboard\products\ProductController;

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
    return view('welcome');
});

Route::group(['prefix'=>'dashboard','middleware'=>'verified'], function() {
    Route::get('/',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('products',[ProductController::class,'products'])->name('products');
    Route::group(['prefix'=>'products','as'=>'products.'], function() {
        Route::get('create',[ProductController::class,'create'])->name('create');
        Route::post('store',[ProductController::class,'store'])->name('store');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::put('update/{id}',[ProductController::class,'update'])->name('update');
        Route::delete('delete/{id}',[ProductController::class,'delete'])->name('delete');
    });

    Route::group(['prefix'=>'users','as'=>'users.'],function() {
        Route::get('/')->name('index');
        Route::get('create')->name('create');
        Route::get('edit/{id}')->name('edit');
        Route::get('delete/{id}')->name('delete');
    });
});



Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


