<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function ordersIndex(Request $request)
    {
        $page = $request->input('page', 1);
        return view('orders', [
            'orderPaginate' => Auth::user()->orders()->orderBy('created_at', 'desc')->paginate(10,['*'], 'page', $page)
        ]);
    }

    public function index($orderId)
    {
        return view('order', ['order' => Order::findOrFail($orderId)]);
    }
}
