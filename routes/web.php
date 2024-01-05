<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
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

Route::get('products', [ProductController::class, 'paginate'])->name('products');
Route::get('product/{productId}', [ProductController::class, 'show'])->name('product');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/logout', [LogoutController::class, 'logout'])->name('auth.logout');

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
