<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductRemoveRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditController extends Controller
{
    public function index(Request $request) {
        $page = $request->input('page', 1);
        return view('edit.edit', ['paginator' => Product::paginate(10, ['*'], 'page', $page)]);
    }

    public function addProductView() {
        $product = new Product();
        return view('edit.addProduct', ['product' => $product]);
    }

    public function updateView($productId) {
        $product = Product::findOrFail($productId);
        return view('edit.updateProduct', ['product' => $product]);
    }

    public function add(ProductAddRequest $request)
    {
        $validated = $request->validated();
        Product::create($validated);
        return redirect()->route('edit.add.index')->with('success', 'Product added successfully');
    }

    public function update(ProductUpdateRequest $request) {
        $validated = $request->validated();
        $product = Product::findOrFail($validated['id']);
        $product->update($validated);
        return redirect()->route('edit.update.index', ['productId' => $product->id])->with('success', 'Product updated successfully');
    }

    public function remove(ProductRemoveRequest $request) {
        $validated = $request->validated();
        $product = Product::findOrFail($validated['id']);
        $product->delete();
        return redirect()->route('edit.index')->with('success', 'Product removed successfully');
    }
}
