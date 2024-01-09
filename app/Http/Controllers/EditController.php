<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function index(Request $request) {
        $page = $request->input('page', 1);
        return view('edit', ['paginator' => Product::paginate(10, ['*'], 'page', $page)]);
    }
}
