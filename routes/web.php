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

Route::group(['namespace' => 'App\Http\Controllers'], function() {

    //home page view
    Route::get('/', 'HomeController@index')->name('home');
    //product list view
    Route::get('/products', 'ProductController@paginate')->name('products');
    //product page view
    Route::get('/product/{productId}', 'ProductController@show')->name('product');

    Route::group(['middleware' => ['guest']], function() {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.login.show');
        Route::get('/register', 'Auth\RegisterController@register')->name('auth.register');
    });

    Route::group(['middleware' => ['auth']], function () {
        //logout
        Route::post('/logout', 'Auth\LogoutController@logout')->name('auth.logout');

        Route::group(['middleware' => ['admin']], function () {
            //edit view (list of products)
            Route::get('/edit', 'EditController@index')->name('edit.index');
            //add product view
            Route::get('/edit/add', 'EditController@addProductView')->name('edit.add.index');
            //update product view
            Route::get('/edit/update/{productId}', 'EditController@updateView')->name('edit.update.index');

            //update product
            Route::post('/edit/update/{productId}', 'EditController@update')
                ->name('edit.update');

            //create product
            Route::post('/edit/add', 'EditController@add')
                ->name('edit.add');

            //remove product
            Route::post('/edit/remove', 'EditController@remove')
                ->name('edit.remove');
        });

        //checkout view
        Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
        //make an order (create order)
        Route::post('/checkout/order', 'CheckoutController@order')->name('checkout.order');
        //order list view
        Route::get('/orders', 'OrderController@ordersIndex')->name('orders.index');
        //order page view
        Route::get('/order/{orderId}', 'OrderController@index')->name('order.index');

        //cart view
        Route::get('/cart', 'CartController@index')->name('cart.index');
        //set items in cart
        Route::post('/cart/set', 'CartController@set')->name('cart.set');
        //update items in cart
        Route::post('/cart/update', 'CartController@update')->name('cart.update');
        //remove item from cart
        Route::post('/cart/remove', 'CartController@remove')->name('cart.remove');
    });


});
Auth::routes();


