<?php

namespace App\Http\Controllers;


use App\src\Cart\Cart;

class CartController extends Controller
{
    public function index()
    {
        $items = \Cart::getContent();//TODO nie mam pojecia naprawde
        return view('cart', ['cart' => $items]);
    }

    public function add($productId)
    {
        \Cart::add(456, $productId, 2);
        $items = Cart::getContent();
        return view('cart', ['cart' => $items]);
    }
//
//    public function add($productId)
//    {
//        $product = Product::find($productId);
//        // Retrieve the cart from the session
//        $cart = session('cart', []);
//
//        // Add the product to the cart
//        $cart[$product->id] = [
//            'quantity' => isset($cart[$product->id]) ? $cart[$product->id]['quantity'] + 1 : 1,
//        ];
//
//        // Store the cart back in the session
//        session(['cart' => $cart]);
//
//        return response()->
//    }
//
//    public function update(Request $request)
//    {
//        $product = Product::find($request->input('productId'));
//        // Retrieve the cart from the session
//        $cart = session('cart', []);
//
//        // Update the quantity for the given product
//        $cart[$product->id]['quantity'] = $request->input('quantity');
//
//        // Store the cart back in the session
//        session(['cart' => $cart]);
//
//        return redirect()->route('cart.index');
//    }
//
//    public function getFromDb(User $user) {
//        $cart = [];
//        foreach($user->cart()->first()->products() as $product) {
//            $cart[$product->id] = 1;
//        }
//        session()->put('cart', $cart);
//
//        return redirect()->route('cart.index');
//    }
//
//    public function saveToDatabase()
//    {
//        $cart = session('cart', []);
//
//        foreach ($cart as $item) {
//            CartItem::create([
//                'product_id' => $item['id'],
//                'quantity' => $item['quantity'],
//                // Add any other fields you need
//            ]);
//        }
//
//        // Clear the cart from the session after saving to the database
//        session(['cart' => []]);
//
//        return redirect()->route('cart.index')->with('success', 'cart items saved to database successfully.');
//    }
}
