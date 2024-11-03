<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use  App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Roleaccessmodule\RoleaccessController;
use App\Http\Controllers\Menus\MenusController;

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

// PUBLIC
Route::post('login',[LoginController::class,'login'])->name('login');
Route::post('register',[RegisterController::class,'register'])->name('register');




Route::middleware(['auth:sanctum','checkstatus'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user(); // Return authenticated user information
    });

    
    Route::Resource('accessmenu',RoleaccessController::class)->names('accessmenu');
    Route::Resource('menu',MenusController::class)->names('menu');
});
