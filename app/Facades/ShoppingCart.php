<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void add($id, $productId, $quantity)
 * @method static void remove($id)
 * @method static void update($id, $data)
 * @method static void addRow($id, $data)
 * @method static void save($cart)
 * @method static \App\Core\Cart\CartCollection getContent()
 * @method static \App\Core\Cart\CartCollection all()
 * @method static void clear()
 */
class ShoppingCart extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'shoppingcart';
    }
}
