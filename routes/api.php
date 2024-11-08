<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use  App\Http\Controllers\Auth\RegisterController;


use App\Http\Controllers\Accessrolemenu\AccessrolemenuController;

use App\Http\Controllers\System\Menus\MenuController;
use App\Http\Controllers\System\Securityroles\SecurityroleController;
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
    Route::post('logout',[LoginController::class,'logout'])->name('logout');

    // Accessrolemenu
    // User access to the menu depends on their role. GET 
    Route::Resource('accessmenu',AccessrolemenuController::class)->names('accessmenu');


    // Menus
    // menu GET , POST 
    Route::Resource('menu',MenuController::class)->names('menu');

    // Security roles
    // securityrole GET , POST 
    Route::Resource('securityrole',SecurityroleController::class)->names('securityrole');
    
});
