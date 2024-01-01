<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
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

    public function show(Product $product)
    {
        return view('product', ['product' => $product]);
    }
}
