<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static session(string $id)
 * @method static add(string $id, mixed $productId, int $quantity)
 * @method static remove(string $id)
 * @method static update(string $id, mixed $productId, int $quantity)
 * @method static all()
 */
class ShoppingCart extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'shoppingcart';
    }
}
