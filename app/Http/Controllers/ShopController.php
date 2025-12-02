<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function index()
    {
        $products = Product::orderBy('id', 'desc')
            ->with(['category', 'brand'])
            ->paginate(10);

        return view('shop.index', compact('products'));
    }
}
