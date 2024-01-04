<?php

namespace App\src\Cart;

class CartItem
{

    /**
     * @param $id
     * @param $quantity
     * @param array|mixed $options
     */
    private $productId;
    private $quantity;
    private $options;
    public function __construct($productId, $quantity, mixed $options)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getOptions(): mixed
    {
        return $this->options;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setOptions(mixed $options): void
    {
        $this->options = $options;
    }


}
