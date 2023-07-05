<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TypesOfAccountController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TransferController;

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
        Route::get('/showUserAccount/{id}',[AccountController::class,'show'])->where('id','[0-9]*')->name('showUserAccount');
        Route::post('/createAccount',[AccountController::class,'create'])->name('createAccount');
        Route::post('/updateAccount',[AccountController::class,'update'])->name('updateAccount');
        Route::post('/deleteAccount',[AccountController::class,'delete'])->name('deleteAccount');
        Route::get('/showTypesOfAccounts',[TypesOfAccountController::class,'index'])->name('showTypesOfAccounts');
        Route::get('/showTypeOfAccounts/{id}',[TypesOfAccountController::class,'show'])->where('id','[0-9]*')->name('showTypeOfAccounts');
        Route::post('/createTypeOfAccounts',[TypesOfAccountController::class,'create'])->name('createTypeOfAccounts');
        Route::post('/updateTypeOfAccounts',[TypesOfAccountController::class,'update'])->name('updateTypeOfAccounts');
        Route::post('/deleteTypeOfAccounts',[TypesOfAccountController::class,'delete'])->name('deleteTypeOfAccounts');
        Route::get('/showInterests',[InterestController::class,'index'])->name('showInterests');
        Route::get('/showInterest/{id}',[InterestController::class,'show'])->name('showInterest');
        Route::post('/createInterest',[InterestController::class,'create'])->name('createInterest');
        Route::post('/updateInterest',[InterestController::class,'update'])->name('updateInterest');
        Route::post('/deleteInterest',[InterestController::class,'delete'])->name('deleteInterest');
        Route::get('/showTransactions',[TransactionController::class,'index'])->name('showTransactions');
        Route::get('/showTransaction/{id}',[TransactionController::class,'show'])->name('showTransaction');
        Route::post('/createTransaction',[TransactionController::class,'create'])->name('createTransaction');
        Route::post('/updateTransaction',[TransactionController::class,'update'])->name('updateTransaction');
        Route::post('/deleteTransaction',[TransactionController::class,'delete'])->name('deleteTransaction');
        Route::get('/showGroups',[GroupController::class,'index'])->name('showGroups');
        Route::get('/showGroup/{id}',[GroupController::class,'show'])->name('showGroup');
        Route::post('/createGroup',[GroupController::class,'create'])->name('createGroup');
        Route::post('/updateGroup',[GroupController::class,'update'])->name('updateGroup');
        Route::post('/deleteGroup',[GroupController::class,'delete'])->name('deleteGroup');
        Route::get('/moveAmount',TransferController::class)->name('moveAmount');

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
