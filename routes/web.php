<?php

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
});

//Route::controller(ProductController::class)->group(function () {
//    Route::get('/products/{page?}', 'paginate');
//})->name('products');

Route::get('products', [ProductController::class, 'paginate'])->name('products');
Route::get('product/{productId}', [ProductController::class, 'show'])->name('product');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/session', function() {
    dd(session()->all());
})->name('session');
Route::get('/debug', function() {
    dd(app()->getLoadedProviders());
})->name('debug');
