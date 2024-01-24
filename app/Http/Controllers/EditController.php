<?php

namespace App\Http\Controllers;

use App\Core\ImageManager;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductRemoveRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditController extends Controller
{
    public function index(Request $request) {
        $page = 1;
        $validator = Validator::make($request->all(), [
            'page' => 'int|min:1'
        ]);
        if(!$validator->fails()) {
            $page = $request->input('page', 1);
        }
        return view('edit.edit', ['paginator' => Product::paginate(10, ['*'], 'page', $page)]);
    }

    public function addProductView() {
        $product = new Product();
        return view('edit.addProduct', ['product' => $product]);
    }

    public function updateView($productId) {
        $validator = Validator::make(['productId' => $productId], [
            'productId' => 'required|int|exists:products,id'
        ]);
        if($validator->fails()) {
            abort(404);
        }
        $product = Product::findOrFail($productId);
        return view('edit.updateProduct', ['product' => $product]);
    }

    public function add(ProductAddRequest $request)
    {
        $validated = $request->validated();
        $image = ImageManager::storeFile($request->file('image'));
        $image->save();
        Product::create([
            'name' => $validated['name'],
            'cost' => $validated['cost'],
            'saleCost' => $validated['saleCost'],
            'quantity' => $validated['quantity'],
            'description' => $validated['description'],
            'image_id' => $image->id
        ]);
        return redirect()->route('edit.add.index')->with('success', 'Product added successfully');
    }

    public function update(ProductUpdateRequest $request) {
        $validated = $request->validated();
        $product = Product::findOrFail($validated['id']);
        $data = [
            'name' => $validated['name'],
            'cost' => $validated['cost'],
            'saleCost' => $validated['saleCost'],
            'quantity' => $validated['quantity'],
            'description' => $validated['description']
        ];
        if($request->file('image') !== null) {
            $image = ImageManager::storeFile($request->file('image'));
            $oldImage = $product->image;
            $product->image()->associate($image);
            $product->save();
            ImageManager::removeIfNotUsed($oldImage, 1);

        }
        $product->update($data);
        return redirect()->route('edit.update.index', ['productId' => $product->id])->with('success', 'Product updated successfully');
    }

    public function remove(ProductRemoveRequest $request) {
        $validated = $request->validated();
        $product = Product::findOrFail($validated['id']);
        ImageManager::removeIfNotUsed($product->image);
        $product->delete();
        return redirect()->route('edit.index')->with('success', 'Product removed successfully');
    }
}
