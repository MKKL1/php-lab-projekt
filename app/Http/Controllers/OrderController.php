<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function ordersIndex(Request $request)
    {
        $page = 1;
        $validator = Validator::make($request->all(), [
            'page' => 'int|min:1'
        ]);
        if(!$validator->fails()) {
            $page = $request->input('page', 1);
        }
        return view('orders', [
            'orderPaginate' => Auth::user()->orders()->orderBy('created_at', 'desc')->paginate(10,['*'], 'page', $page)
        ]);
    }

    public function index($orderId)
    {
        $validator = Validator::make(['orderId' => $orderId], [
            'orderId' => 'required|int|exists:orders,id'
        ]);
        if($validator->fails()) {
            abort(404);
        }
        return view('order', ['order' => Order::findOrFail($orderId)]);
    }
}
