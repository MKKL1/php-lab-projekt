<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function paginate(Request $request) {
        $page = $request->input('page', 1);
        return view('products', ['paginator' => Product::paginate(3, ['*'], 'page', $page)]);
    }

//    public function store(Request $request)
//    {
//        $data = $request->validate([
//            'name' => ['required'],
//            'cost' => ['required', 'numeric'],
//            'saleCost' => ['nullable', 'numeric'],
//            'quantity' => ['required', 'integer'],
//            'description' => ['nullable'],
//            'image' => ['required'],
//        ]);
//
//        return new ProductResource(Product::create($data));
//    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('product', ['product' => $product]);
    }
}
