<?php

namespace App\Http\Controllers;

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
        if(Auth::user()->cart()->exists()) {
            $cart = Auth::user()->cart;
        } else {
            $cart = new Cart();
        }

        $products = $cart->products;
        $totalCost = 0;
        $totalSaleCost = 0;
        foreach($products as $product) {
            $totalCost += $product->cost * $product->pivot->quantity;
            $totalSaleCost += $product->calculatedPrice() * $product->pivot->quantity;
        }

        //$cart = Auth::user()->cart;
        $expectedDeliveryStart = new DateTime();
        $expectedDeliveryStart->modify('+1 day');
        $expectedDeliveryEnd = new DateTime();
        $expectedDeliveryEnd->modify('+3 day');
        return view('cart' , [
            'cart' => $cart,
            'totalCost' => $totalCost,
            'totalSaleCost' => $totalSaleCost,
            'expectedDeliveryStart' => $expectedDeliveryStart,
            'expectedDeliveryEnd' => $expectedDeliveryEnd
        ]);
    }

    public function remove(CartRemoveRequest $request)
    {
        $validated = $request->validated();
        $detached = Auth::user()->cart->products()->detach($validated['productId']);
        if($detached > 0) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function update(CartUpdateRequest $request)
    {
        $validated = $request->validated();
        $this->sync($validated, false);
        return response()->json(['success' => true]);
    }

    private function sync($validated, $detach = true) {
        $data = [];
        foreach ($validated['items'] as $productArray) {
            $data[$productArray['productId']] = ['quantity' => $productArray['quantity']];
        }
        error_log(json_encode($data));
        $user = Auth::user();
        if(!$user->cart()->exists()) {
            $user->cart()->create([
                'user_id' => $user->id,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ]);
        }
        Auth::user()->cart->products()->sync($data, $detach);
    }
}
