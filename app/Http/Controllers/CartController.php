<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //ShoppingCart::add(uuid_create(), 3, 1);
        $cart = ShoppingCart::getCart();
        $price = $cart->price();
        $data = [];
        foreach ($cart as $key => $value) {
            $data[$key] = ['product' => Product::find($value['productId']), 'quantity' => $value['quantity']];
        }
        return view('cart' , ['cartData' => $data, 'price' => $price]);
    }

    /**
     * Used for adding one product to the cart.
     */
    public function add(Request $request)
    {
        ShoppingCart::add(uuid_create(), $request->input('productId'), $request->input('quantity'));
        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        ShoppingCart::remove($request->input('id'));
        return response()->json(['success' => true]);
    }
    public function update(Request $request)
    {
        ShoppingCart::add($request->input('id'), $request->input('productId'), $request->input('quantity'));
        return response()->json(['success' => true]);
    }
}
