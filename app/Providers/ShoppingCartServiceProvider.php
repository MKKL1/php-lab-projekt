<?php

namespace App\Providers;

use App\Core\Cart\ShoppingCart;
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
    }
}
