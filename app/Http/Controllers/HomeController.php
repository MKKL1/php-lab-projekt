<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Zapisz do cache na 60 sekund najcześciej zamawiane produkty
        $products = Cache::remember('products', 60, function () {
            return Product::withCount('orders')
                ->orderByDesc('orders_count')
                ->take(10)
                ->get();
        });
        return view('home', ['products' => $products]);
    }
}
