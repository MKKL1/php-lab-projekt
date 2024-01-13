<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        return view('orders', [
            'orderPaginate' => Auth::user()->orders()->paginate(10,['*'], 'page', $page)
        ]);
    }
}
