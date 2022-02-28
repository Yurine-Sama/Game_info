<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderController;
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

//API AUTH
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);


Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/show/{id}', [ProductController::class, 'show']);
//get order details
Route::get('admin/order', [OrderController::class, 'showOrder']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/product/store', [ProductController::class, 'store']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::delete('/product/del/{id}', [ProductController::class, 'destroy']);
    //admin only
    Route::get('/Checkout', [OrderDetailController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/product/search/{name}', [ProductController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
