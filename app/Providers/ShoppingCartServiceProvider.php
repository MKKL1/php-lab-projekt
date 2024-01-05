<?php

namespace App\Providers;

use App\Core\Cart\ShoppingCart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ShoppingCartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('shoppingcart', function () {
           return new ShoppingCart();
        });
    }

    public function boot(): void
    {
        View::share('shopping_cart_count', \App\Facades\ShoppingCart::count());
    }
}
