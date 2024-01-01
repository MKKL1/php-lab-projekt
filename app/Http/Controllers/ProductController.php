<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'cost' => ['required', 'numeric'],
            'saleCost' => ['nullable', 'numeric'],
            'quantity' => ['required', 'integer'],
            'description' => ['nullable'],
            'image' => ['required'],
        ]);

        return new ProductResource(Product::create($data));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required'],
            'cost' => ['required', 'numeric'],
            'saleCost' => ['nullable', 'numeric'],
            'quantity' => ['required', 'integer'],
            'description' => ['nullable'],
            'image' => ['required'],
        ]);

        $product->update($data);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }
}
