<?php

use App\Http\Controllers\Api\ApiController;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});
Route::prefix('v1')->group(function () {

    Route::get('jalalStore/categories', [ApiController::class, 'categories'])->middleware('only');
    Route::get('jalalStore/products', [ApiController::class, 'products'])->middleware('only');
    Route::get('/jalalStore/images', [ApiController::class, 'images']);

    Route::post('jalalStore/register', [ApiController::class, 'registerMobileUSer'])->middleware('MobileUser');
    Route::post('jalalStore/login', [ApiController::class, 'loginMobileUser'])->middleware('MobileUser');
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('jalalStore/user', [ApiController::class, 'userDetails']);
        Route::post('jalalStore/cart/store', [ApiController::class, 'cartData']);
        Route::get('jalalStore/cart', [ApiController::class, 'cart']);
        Route::delete('jalalStore/logout', [ApiController::class, 'mobileUserlogout']);
    });
    // Route::get('jalalStore/broad', [ApiController::class, 'broadCast'])->middleware('api');
});

