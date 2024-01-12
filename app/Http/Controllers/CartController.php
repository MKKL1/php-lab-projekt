<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartRemoveRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Models\Cart;
use Carbon\Carbon;
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
        $data = [];
        foreach ($validated['items'] as $productArray) {
            $data[$productArray['productId']] = ['quantity' => $productArray['quantity']];
        }
        $user = Auth::user();
        if(!$user->cart()->exists()) {
          $user->cart()->create([
              'user_id' => $user->id,
              'updated_at' => Carbon::now(),
              'created_at' => Carbon::now()
          ]);
        }
        Auth::user()->cart->products()->sync($data, false);
        return response()->json(['success' => true]);
    }
}
