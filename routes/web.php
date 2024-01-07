<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

//Route::controller(ProductController::class)->group(function () {
//    Route::get('/products/{page?}', 'paginate');
//})->name('products');


Route::group(['namespace' => 'App\Http\Controllers'], function() {

    Route::get('products', 'ProductController@paginate')->name('products');
    Route::get('product/{productId}', 'ProductController@show')->name('product');

    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart/add', 'CartController@add')->name('cart.add');
    Route::post('/cart/remove', 'CartController@remove')->name('cart.remove');
    Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');
    Route::post('/cart/update', 'CartController@update')->name('cart.update');


    Route::group(['middleware' => ['guest']], function() {
        Route::get('/login', 'LoginController@showLoginForm')->name('auth.login.show');
        Route::post('/login', 'LoginController@login')->name('auth.login');
        Route::get('/register', 'RegisterController@register')->name('auth.register');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::post('/logout', 'LogoutController@logout')->name('auth.logout');
    });
});


Route::get('/session', function() {
    dd(session()->all());
})->name('session');
Route::get('/cartdata', function() {
    dd(\App\Facades\ShoppingCart::getCart());
})->name('cartdata');
Route::get('/debug', function() {
    dd(app()->getLoadedProviders());
})->name('debug');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
