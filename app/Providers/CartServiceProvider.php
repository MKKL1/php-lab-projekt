<?php

namespace App\Providers;

use App\src\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {+
        $this->app->singleton('cart', function () {
            return new Cart();
        });
    }

    public function boot(): void
    {
    }
}
