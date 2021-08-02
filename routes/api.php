<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('login', [\App\Http\Controllers\AppiController::class, 'login']);
Route::post('register', [\App\Http\Controllers\AppiController::class, 'register']);
Route::middleware('auth:api')->group(function () {

    Route::post('/user', function () {

        return \Illuminate\Support\Facades\Auth::user();

    });

    Route::post('ruyaekle', [\App\Http\Controllers\AppiController::class, 'ruyaekle']);
    Route::post('ruya', [\App\Http\Controllers\AppiController::class, 'ruyaliste']);
    Route::post('ruyadetay', [\App\Http\Controllers\AppiController::class, 'ruyadetay']);
    Route::post('tabirekle', [\App\Http\Controllers\AppiController::class, 'tabirekle']);
    Route::post('tabirdetay', [\App\Http\Controllers\AppiController::class, 'tabirdetay']);


});
