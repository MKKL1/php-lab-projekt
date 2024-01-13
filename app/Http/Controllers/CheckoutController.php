<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
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

    public function order(OrderCreateRequest $request)
    {
        $validated = $request->validated();
        $cart = Auth::user()->cart;
        if(!isset($cart) || !$cart->exists()) return redirect()->route('cart.index')->with('error', 'Cart is empty');
        $products = $cart->products;
        if($products->isEmpty()) return redirect()->route('cart.index')->with('error', 'Cart is empty');
        $products = $cart->products;
        $cart->products()->detach();
        $order = Auth::user()->orders()->create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $order->products()->attach($products->mapWithKeys(function ($product) {
            return [$product->id => [
                'quantity' => $product->pivot->quantity,
                'cost' => $product->cost
            ]];
        }));
        return redirect()->route('orders.index')->with('success', 'Order placed successfully');
    }
}
