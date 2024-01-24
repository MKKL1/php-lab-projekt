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
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function paginate(ProductsShowRequest $request) {
        $validated = $request->validated();
        $page = $request->has('page') ? $validated['page'] : 1;
        $query = Product::query();

        if($request->has('sort')) {
            $direction = 'ASC';
            switch ($validated['sort']) {
                case "maxcost": $direction = 'DESC'; break; //TODO sort by saleCost as well
                case "mincost": $direction = 'ASC'; break;
            }

            $query->orderByRaw("COALESCE(saleCost, cost) $direction");
        }
        $paginator = $query->paginate(10, ['*'], 'page', $page);
        return view('products', ['paginator' => $paginator]);
    }


    public function show($productId)
    {
        $validator = Validator::make(['productId' => $productId], [
            'productId' => 'required|int|exists:products,id'
        ]);
        if($validator->fails()) {
            abort(404);
        }
        $product = Product::findOrFail($productId);
        return view('product', ['product' => $product]);
    }
}
