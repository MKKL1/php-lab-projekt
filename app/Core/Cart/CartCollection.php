<?php

namespace App\Core\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

/**
 * Collection of CartItemCollection
 */
class CartCollection extends Collection
{
    public function price(): float|int
    {
        $sum = 0;
        foreach ($this as $value) {
            $sum += Product::find($value['productId'])->realPrice() * $value['quantity'];
        }
        return $sum;
    }
}
