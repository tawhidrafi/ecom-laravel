<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Auth;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function about()
    {
        return view('user.about');
    }

    //
    public function shop()
    {
        $cart = Auth::user()->cart()->with(['items', 'items.product'])->first();
        $wishList = Auth::user()->wishList()->with(['items', 'items.product'])->first();
        $products = Product::orderBy('id', 'desc')
            ->with(['category', 'brand'])
            ->paginate(10);

        return view('user.shop.index', compact('products', 'cart', 'wishList'));
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
        return view('user.shop.detail', compact('product', 'products', 'cart', 'wishList'));
    }
}
