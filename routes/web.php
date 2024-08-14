<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function(){
    Route::get('/' , [UserController::class, 'login'])->name('user.login');
    Route::get('/login' , [UserController::class, 'login'])->name('user.login');
    Route::post('/login' , [UserController::class, 'loginPost'])->name('user.loginPost');


});

Route::middleware('auth')->group(function(){
    Route::post('/logout' , [UserController::class, 'logout'])->name('user.logout');
    //a middleware to make sure the users can only view their own workspace
    Route::middleware('check.workspace.access')->group(function(){
        Route::resource('/workspace' , WorkspaceController::class);
        Route::put('/workspace/{workspace}/update-quota' , [WorkspaceController::class, 'updateQuota'])->name('workspace.updateQuota');
        Route::resource('/workspace/{workspace}/token' , ApiTokenController::class);
        Route::get('workspace/{workspace}/check-bill', [WorkspaceController::class , 'showBill'])->name('workspace.checkBill');
    });
});
