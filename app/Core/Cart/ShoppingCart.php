<?php

namespace App\Core\Cart;

class ShoppingCart
{

    private string $sessionKeyCartItems = 'cart';

    public function __construct()
    {
    }

    public function add($id, $productId, $quantity): void
    {
        $cart = $this->getContent();
        $data = [
            'productId' => $productId,
            'quantity' => $quantity
        ];
        if($cart->has($id))
            $this->update($id, $data);
        else $this->addRow($id, $data);

    }

    public function remove($id): void
    {
        $cart = $this->getContent();
        $cart->forget($id);
        $this->save($cart);
    }

    //TODO private
    public function update($id, $data): void
    {
        $cart = $this->getContent();
        $cart->put($id, $data); //TODO should update invidual data
        $this->save($cart);
    }

    //private
    public function addRow($id, $data): void
    {
        $cart = $this->getContent();
        $cart->put($id, new CartItemCollection($data));
        $this->save($cart);
    }

    //private
    public function save($cart): void
    {
        session()->put($this->sessionKeyCartItems, $cart);
    }

    public function saveToDatabase($cart): void
    {

    }

    public function getContent(): CartCollection
    {
        return (new CartCollection(session()->get($this->sessionKeyCartItems)))->reject(function($item) {
            return ! ($item instanceof CartItemCollection);
        });
    }

    public function all(): CartCollection
    {
        return $this->getContent();
    }

    public function clear(): void
    {
        session()->forget($this->sessionKeyCartItems);
    }
}
