<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return Cart::all();
    }

    public function show($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        return view('cart', ['cart' => $cart]);
    }

    public function addToCart(Request $request) {
        session()->flash();
    }
}
