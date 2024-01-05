<?php

namespace App\Facades;

use App\Core\Cart\CartCollection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static session(string $id)
 * @method static add(string $id, mixed $productId, int $quantity)
 * @method boolean remove(string $id)
 * @method static update(string $id, mixed $data)
 * @method static clear()
 * @method CartCollection getCart()
 * @method int count()
 */
class ShoppingCart extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'shoppingcart';
    }
}
