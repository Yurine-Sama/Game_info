<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

Route::get('admin/Checkout', [App\Http\Controllers\HomeController::class, 'admin_checkout'])->name('admin');

Route::get('admin/CheckOrder', [App\Http\Controllers\HomeController::class, 'admin_orderCheck'])->name('admin');

Route::resource('orders', OrderController::class);

Route::post('/orders', 'App\Http\Controllers\OrderController@store')->name('Order');


Route::get('/search/{name}', [App\Http\Controllers\HomeController::class, 'search_controller'])->name('search');
