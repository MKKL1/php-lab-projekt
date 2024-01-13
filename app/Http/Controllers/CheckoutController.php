<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;
        if(!$cart->exists()) return redirect()->route('cart.index')->with('error', 'Cart is empty');
        $products = $cart->products;
        if($products->isEmpty()) return redirect()->route('cart.index')->with('error', 'Cart is empty');
        $totalCost = 0;
        $totalSaleCost = 0;
        foreach($products as $product) {
            $totalCost += $product->cost * $product->pivot->quantity;
            $totalSaleCost += $product->calculatedPrice() * $product->pivot->quantity;
        }

        return view('checkout', [
            'cart' => $cart,
            'totalCost' => $totalCost,
            'totalSaleCost' => $totalSaleCost
        ]);
    }

    public function order()
    {
        $cart = Auth::user()->cart;
        if(!$cart->exists()) return redirect()->route('cart.index')->with('error', 'Cart is empty');
        $products = $cart->products;
        if($products->isEmpty()) return redirect()->route('cart.index')->with('error', 'Cart is empty');
        $cart->products()->detach();
        return redirect()->route('checkout.order.index')->with('success', 'Order placed successfully');
    }
}
