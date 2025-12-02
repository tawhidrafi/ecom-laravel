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
    // show
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['category', 'brand'])
            ->first();
        $products = Product::where('slug', '<>', $slug)->get()->take(8);
        return view('shop.detail', compact('product', 'products'));
    }
}
