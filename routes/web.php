<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('index');
    }
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin_controller'])->name('admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('orders', OrderController::class);

Route::post('/orders', 'App\Http\Controllers\OrderController@store')->name('Order');

//set token to use in orders page.
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();

    $token = csrf_token();

    // ...
});

Route::get('/search/{name}', [App\Http\Controllers\HomeController::class, 'search_controller'])->name('search');
