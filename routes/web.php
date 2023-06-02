<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountController;

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

Route::domain('localhost')->group(function(){

    Route::middleware('auth')->group(function(){

        Route::get('/showAccounts',[AccountController::class,'index'])->name('showAccounts');
        Route::get('/showUserAccount/{id}',[AccountController::class,'show'])->where('id','^[0-9]*$')->name('showUserAccount');
        Route::post('/createAccount',[AccountController::class,'create'])->name('createAccount');
        Route::post('/updateAccount',[AccountController::class,'update'])->name('updateAccount');
        Route::post('/deleteAccount',[AccountController::class,'delete'])->name('deleteAccount');

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
