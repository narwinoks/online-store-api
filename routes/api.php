<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\ProfileController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });

    Route::prefix('google')->controller(GoogleController::class)->group(function () {
        Route::get('/', 'redirectToGoogle');
        Route::get('callback', 'handleGoogleCallback');
    });
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
    });
});
