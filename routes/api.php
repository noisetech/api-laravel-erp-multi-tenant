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
Route::post('/register', [App\Http\Controllers\ApiController\RegisterController::class, 'register']);

//group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function() {


    Route::get('users', [App\Http\Controllers\ApiController\UserController::class, 'getAllUser']);

    Route::get('/permissions', [App\Http\Controllers\ApiController\PermissionController::class, 'index']);
    //logout
    Route::post('/logout', [App\Http\Controllers\ApiController\LoginController::class, 'logout']);
    Route::post('/logout', [App\Http\Controllers\ApiController\LoginController::class, 'logout']);

    Route::post('roles/simpan', [App\Http\Controllers\ApiController\RoleController::class, 'simpan']);


    // perusahaan


    Route::get('/bidang-perusahaan', [App\Http\Controllers\ApiController\BidangPerusahaanController::class, 'index']);
    Route::post('/bidang-perusahaan', [App\Http\Controllers\ApiController\BidangPerusahaanController::class, 'simpan']);
    Route::put('/bidang-perusahaan/disabled/{id}', [App\Http\Controllers\ApiController\BidangPerusahaanController::class, 'disabled']);
    Route::put('/bidang-perusahaan/enable/{id}', [App\Http\Controllers\ApiController\BidangPerusahaanController::class, 'enabled']);

});
