<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\Products\CategoryController;
use App\Http\Controllers\Api\Products\ColorController;
use App\Http\Controllers\Api\Products\ImageController;
use App\Http\Controllers\Api\Products\ProductController;
use App\Http\Controllers\Api\Products\ProductItemController;
use App\Http\Controllers\Api\Products\ReviewController;
use App\Http\Controllers\Api\Products\SizeController;
use App\Http\Controllers\Api\Products\TagController;
use App\Http\Controllers\Api\Products\VariantsController;
use App\Http\Controllers\Api\ProfileController;
use App\Models\Api\Products\Category;
use Carbon\Carbon;
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
Route::prefix('user')->group(function () {
    Route::controller(AddressController::class)->group(function () {
        Route::prefix('address')->group(function () {
            Route::post('/', 'store')->middleware('auth:sanctum');
            Route::delete('/', 'destroy')->middleware('auth:sanctum');
            Route::put('/', 'update')->middleware('auth:sanctum');
        });
    });
});
Route::prefix('products')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('/{id?}', 'index');
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
        Route::get('/', 'list')->middleware('auth:sanctum');
    });
    Route::prefix('review')->group(function () {
        Route::controller(ReviewController::class)->group(function () {
            Route::post('/', 'store')->middleware('auth:sanctum');
            Route::delete('/', 'destroy')->middleware('auth:sanctum');
        });
    });
    Route::prefix('tags')->group(function () {
        Route::controller(TagController::class)->group(function () {
            Route::post('/', 'store')->middleware('auth:sanctum');
            Route::delete('/', 'destory')->middleware('auth:sanctum');
            Route::get('/{title}', 'serach')->middleware('auth:sanctum');
        });
    });
    Route::controller(ImageController::class)->group(function () {
        Route::post('/image', 'store');
    });
    Route::prefix('item')->group(function () {
        Route::prefix('size')->group(function () {
            Route::controller(SizeController::class)->group(function () {
                Route::get('{id?}', 'index');
                Route::post('/', 'store');
                Route::delete('/', 'destroy');
                Route::put('/', 'update');
            });
        });
        Route::prefix('color')->group(function () {
            Route::controller(ColorController::class)->group(function () {
                Route::get('{id?}', 'index');
                Route::post('/', 'store');
                Route::delete('/', 'destroy');
                Route::put('/', 'update');
            });
        });

        Route::prefix('variants')->group(function () {
            Route::controller(VariantsController::class)->group(function () {
                Route::post('/', 'store');
                Route::put('/', 'update');
                Route::delete('/', 'destroy');
                Route::get('/{id}', 'show');
            });
        });
        Route::prefix('items')->group(function () {
            Route::controller(ProductItemController::class)->group(function () {
                Route::post('/', 'store');
                Route::put('/', 'update');
                Route::delete('/', 'destroy');
                Route::get('/{id}', 'show');
            });
        });
    });
    Route::get('tes', [SizeController::class, 'index']);
});

Route::prefix('cart')->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::get('/', 'index')->middleware('auth:sanctum');
    });
});
Route::get('tes', [VariantsController::class, 'tes']);
