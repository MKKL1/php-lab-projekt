<?php

namespace App\Core\Cart;

use Exception;

class ShoppingCart
{

    private string $sessionKeyCartItems = 'cart';
    private mixed $sessionKey = 'default_key';

    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public function session($sessionKey): static
    {
        if (!$sessionKey) throw new Exception("Session key is required.");

        $this->sessionKey = $sessionKey;
        $this->sessionKeyCartItems = $this->sessionKey . '_cart_items';

        return $this;
    }

    public function add($id, $productId, $quantity): static
    {
        $cart = $this->getCart();
        $data = [
            'productId' => $productId,
            'quantity' => $quantity
        ];
        if($cart->has($id))
            $this->update($id, $data);
        else $this->addRow($id, $data);
        return $this;
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        $cart->forget($id);
        $this->save($cart);

        return $this;
    }

    //TODO private
    public function update($id, $data): void
    {
        $cart = $this->getCart();
        $cart->put($id, $data); //TODO should update invidual data
        $this->save($cart);
    }

    //private
    public function addRow($id, $data): void
    {
        $cart = $this->getCart();
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

    public function getCart(): CartCollection
    {
        return (new CartCollection(session()->get($this->sessionKeyCartItems)))->reject(function($item) {
            return ! ($item instanceof CartItemCollection);
        });
    }

    public function count(): int
    {
        return count($this->getCart());
    }

    public function clear()
    {
        session()->forget($this->sessionKeyCartItems);
        return $this;
    }
}
