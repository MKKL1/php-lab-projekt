<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        ShoppingCart::add(uuid_create(), 3, 1);
        return view('cart' , ['cart' => ShoppingCart::all()]);
    }

    /**
     * Used for adding one product to the cart.
     */
    public function add(Request $request)
    {
        ShoppingCart::add($request->input('id'), $request->input('productId'), $request->input('quantity'));
        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        ShoppingCart::remove($request->input('id'));
        return redirect()->route('cart.index');
    }
    public function update(Request $request)
    {
        ShoppingCart::add($request->input('id'), $request->input('productId'), $request->input('quantity'));
        return redirect()->route('cart.index');
    }
}
