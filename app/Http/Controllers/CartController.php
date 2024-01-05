<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartRemoveRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Models\Product;
use App\Providers\ShoppingCartServiceProvider;
use DateTime;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
        $cart = ShoppingCart::getCart();
        $price = $cart->price();
        $data = [];
        foreach ($cart as $key => $value) {
            $data[$key] = ['product' => Product::find($value['productId']), 'quantity' => $value['quantity']];
        }
        $expectedDeliveryStart = new DateTime();
        $expectedDeliveryStart->modify('+1 day');
        $expectedDeliveryEnd = new DateTime();
        $expectedDeliveryEnd->modify('+3 day');
        return view('cart' , ['cartData' => $data, 'price' => $price,'expectedDeliveryStart' => $expectedDeliveryStart,'expectedDeliveryEnd' => $expectedDeliveryEnd]);
    }

    /**
     * Add one product to the cart.
     */
    public function add(CartAddRequest $request)
    {
        $validated = $request->validated();
        $id = uuid_create();
        ShoppingCart::add($id, $validated['productId'], $validated['quantity']);
        return response()->json(['success' => true, 'id' => $id]);
    }

    public function remove(CartRemoveRequest $request)
    {
        $validated = $request->validated();
        $removed = ShoppingCart::remove($validated['id']);
        return response()->json(['success' => true, 'removed' => $removed]);
    }

    public function clear()
    {
        ShoppingCart::clear();
        return response()->json(['success' => true]);
    }

    public function update(CartUpdateRequest $request)
    {
        $validated = $request->validated();
        $data = [];
        if(array_key_exists('productId', $validated))
            $data['productId'] = $validated['productId'];
        if(array_key_exists('quantity', $validated))
            $data['quantity'] = $validated['quantity'];

        ShoppingCart::update($validated['id'], $data);
        return response()->json(['success' => true]);
    }
}
