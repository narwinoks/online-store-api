<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\Products\CategoryController;
use App\Http\Controllers\Api\Products\ImageController;
use App\Http\Controllers\Api\Products\ProductController;
use App\Http\Controllers\Api\Products\ReviewController;
use App\Http\Controllers\Api\ProfileController;
use App\Models\Api\Products\Category;
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
        Route::post('/avatar', 'avatar')->middleware('auth:sanctum');
        Route::put('/', 'update')->middleware('auth:sanctum');
    });
});

Route::prefix('products')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store')->middleware('auth:sanctum');
            Route::put('/', 'update')->middleware('auth:sanctum');
            Route::delete('/', 'destroy')->middleware('auth:sanctum');
        });
    });
    Route::controller(ProductController::class)->group(function () {
        Route::prefix('list')->group(function () {
            Route::get('/{category:slug}', 'index')->middleware('auth:sanctum');
        });
        Route::get('/{product:slug}', 'show');
        Route::post('/product', 'store')->middleware('auth:sanctum');
        Route::put('/product', 'update')->middleware('auth:sanctum');
        Route::delete('/product', 'destroy')->middleware('auth:sanctum');
        Route::prefix('review')->group(function () {
            Route::controller(ReviewController::class)->group(function () {
                Route::post('/', 'store')->middleware('auth:sanctum');
                Route::delete('/', 'destroy')->middleware('auth:sanctum');
            });
        });
    });

    Route::controller(ImageController::class)->group(function () {
        Route::post('/image', 'store');
    });
    // Route::controller(ProductController::class)->group(function () {
    //     Route::prefix('list')->group(function () {
    //         Route::get('/{category:slug}', function (Category $category) {
    //             $product =   $category->Product->load('category');
    //             dd($product);
    //         });

    //         Route::get('tes', function () {
    //             return "okke";
    //         });
    //     });
    // });
    // Route::prefix('');
});
