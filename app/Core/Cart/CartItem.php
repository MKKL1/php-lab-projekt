<?php

namespace App\Core\Cart;

class CartItem
{
    protected mixed $productId;
    protected int $quantity;

    /**
     * @param mixed $productId
     * @param int $quantity
     */
    public function __construct(mixed $productId, int $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getProductId(): mixed
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }


}
