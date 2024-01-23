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

//Route::controller(ProductController::class)->group(function () {
//    Route::get('/products/{page?}', 'paginate');
//})->name('products');


Route::group(['namespace' => 'App\Http\Controllers'], function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/products', 'ProductController@paginate')->name('products');
    Route::get('/product/{productId}', 'ProductController@show')->name('product');




    Route::group(['middleware' => ['guest']], function() {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.login.show');
        Route::get('/register', 'Auth\RegisterController@register')->name('auth.register');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::post('/logout', 'Auth\LogoutController@logout')->name('auth.logout');
        Route::group(['middleware' => ['admin']], function () {
            Route::get('/edit', 'EditController@index')->name('edit.index');
            Route::get('/edit/add', 'EditController@addProductView')->name('edit.add.index');
            Route::get('/edit/update/{productId}', 'EditController@updateView')->name('edit.update.index');

            Route::post('/edit/update/{productId}', 'EditController@update') //TODO is productId even needed?
                ->can('update-products') //TODO not needed
                ->name('edit.update');

            Route::post('/edit/add', 'EditController@add')
                ->can('add-products') //TODO not needed
                ->name('edit.add');

            Route::post('/edit/remove', 'EditController@remove')
                ->name('edit.remove');
        });

        Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
        Route::post('/checkout/order', 'CheckoutController@order')->name('checkout.order');
        Route::get('/orders', 'OrderController@ordersIndex')->name('orders.index');
        Route::get('/order/{orderId}', 'OrderController@index')->name('order.index');

        Route::get('/cart', 'CartController@index')->name('cart.index');
        Route::post('/cart/set', 'CartController@set')->name('cart.set');
        Route::post('/cart/update', 'CartController@update')->name('cart.update');
        Route::post('/cart/remove', 'CartController@remove')->name('cart.remove');
    });


});
Auth::routes();

Route::get('/session', function() {
    dd(session()->all());
})->name('session');
Route::get('/cartdata', function() {
    dd(\App\Facades\ShoppingCart::getCart());
})->name('cartdata');
Route::get('/debug', function() {
    dd(Product::all()->first()->image->url());
})->name('debug');


