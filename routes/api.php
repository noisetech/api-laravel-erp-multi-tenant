<?php

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

//route login
Route::post('/login', [App\Http\Controllers\ApiController\LoginController::class, 'index']);

//group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function() {

    Route::get('/permissions', [App\Http\Controllers\ApiController\PermissionController::class, 'index']);
    //logout
    Route::post('/logout', [App\Http\Controllers\ApiController\LoginController::class, 'logout']);
    Route::post('/logout', [App\Http\Controllers\ApiController\LoginController::class, 'logout']);

});
