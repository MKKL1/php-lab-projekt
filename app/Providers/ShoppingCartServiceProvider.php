<?php

namespace App\Providers;

use App\Facades\ShoppingCart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ShoppingCartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('shoppingcart', function () {
           return new \App\Core\Cart\ShoppingCart();
        });
    }

    public function boot(): void
    {
        View::share('shopping_cart_count', ShoppingCart::count());
    }
}
