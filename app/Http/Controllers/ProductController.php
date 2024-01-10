<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function paginate(Request $request) {
        $page = $request->input('page', 1);
        return view('products', ['paginator' => Product::paginate(10, ['*'], 'page', $page)]);
    }


    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('product', ['product' => $product]);
    }
}
