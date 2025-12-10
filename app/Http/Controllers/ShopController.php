<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    //
    public function index()
    {
        $cart = Auth::user()->cart()->with(['items', 'items.product'])->first();
        $wishList = Auth::user()->wishList()->with(['items', 'items.product'])->first();
        $products = Product::orderBy('id', 'desc')
            ->with(['category', 'brand'])
            ->paginate(10);

        return view('shop.index', compact('products', 'cart', 'wishList'));
    }
    // show
    public function show($slug)
    {
        $cart = Auth::user()->cart()->with('items')->first();
        $wishList = Auth::user()->wishList()->with('items')->first();
        $product = Product::where('slug', $slug)
            ->with(['category', 'brand'])
            ->first();
        $products = Product::where('slug', '<>', $slug)->get()->take(8);
        return view('shop.detail', compact('product', 'products', 'cart', 'wishList'));
    }
}
