<?php

namespace App\Http\Controllers;

use App\Facades\ShoppingCart;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductsShowRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function paginate(ProductsShowRequest $request) {
        $validated = $request->validated();
        $page = $request->has('page') ? $validated['page'] : 1;
        $table = Product::query();

        if($request->has('sort')) {
            $direction = 'asc';
            switch ($validated['sort']) {
                case "maxcost": $direction = 'desc'; break; //TODO sort by saleCost as well
                case "mincost": $direction = 'asc'; break;
            }
            $table->orderBy('cost', $direction);
        }
        $paginator = $table->paginate(10, ['*'], 'page', $page);
        return view('products', ['paginator' => $paginator]);
    }


    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('product', ['product' => $product]);
    }
}
