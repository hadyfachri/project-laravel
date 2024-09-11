<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'issueToken'])->name('login');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('product', ProductController::class);
    Route::apiResource('order', OrderItemController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('register', RegisterController::class);
    
});
