<?php

namespace App\src\Cart;

class Cart
{
    private $sessionKeyCartItems = "cart";

    public function __construct()
    {
    }

    public function add($id, $productId, $quantity, $options = [])
    {
        $data = array(
            'id' => $id,
            'productId' => $productId,
            'quantity' => $quantity,
            'options' => $options
        );
        $item = $this->validate($data);
        $cart = $this->getContent();
        if($cart->has($item)) {
            $this->update($id, $item);
        } else {
            $this->addRow($id, $item);
        }

        return $this;
    }

    public function update($id, array $data)
    {
        $cart = $this->getContent();
        $item = $cart->pull($id);
        foreach ($data as $key => $value) {
            $item[$key] = $value;
        }
        $cart->put($id, $item);
        $this->save($cart);

        return $this;
    }

    public function addRow($id, array $item)
    {
        $cart = $this->getContent();
        $cart->put($id, new ItemCollection($item));
        $this->save($cart);

        return $this;
    }

    private function validate(array $data)
    {
        return $data;//TODO
    }

    public function getContent()
    {
        return (new CartCollection(session()->get($this->sessionKeyCartItems)))->reject(function($item) {
            return ! ($item instanceof ItemCollection);
        });
    }

    public function save(CartCollection $cart)
    {
        session()->put($this->sessionKeyCartItems, $cart);
    }

}
