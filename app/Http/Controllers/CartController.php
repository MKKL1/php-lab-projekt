<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartRemoveRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Models\Cart;
use App\Models\Product;
use DateTime;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function index()
    {
        $cart = Auth::user()->cart;
        $expectedDeliveryStart = new DateTime();
        $expectedDeliveryStart->modify('+1 day');
        $expectedDeliveryEnd = new DateTime();
        $expectedDeliveryEnd->modify('+3 day');
        return view('cart' , [
            'cart' => $cart,
            'expectedDeliveryStart' => $expectedDeliveryStart,
            'expectedDeliveryEnd' => $expectedDeliveryEnd]);
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

        return response()->json(['success' => true]);
    }
}
