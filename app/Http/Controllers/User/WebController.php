<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Auth;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view('user.home', [
            'categories' => Category::active()
                ->select('id', 'name', 'slug', 'image')
                ->get(),

            'featuredProducts' => Product::active()
                ->featured()
                ->latest()
                ->take(8)
                ->get(),
        ]);
    }

    public function about()
    {
        return view('user.about');
    }

    //
    public function shop()
    {
        $user = Auth::user();

        $cart = optional($user)->cart()?->with(['items', 'items.product'])->first();

        $wishList = optional($user)->wishList()?->with(['items', 'items.product'])->first();

        $products = Product::with(['category', 'brand'])->latest()->paginate(10);

        return view('user.shop.index', compact('products', 'cart', 'wishList'));
    }

    // show
    public function show($slug)
    {
        $user = Auth::user();

        $cart = optional($user)->cart()?->with(['items', 'items.product'])->first();

        $wishList = optional($user)->wishList()?->with(['items', 'items.product'])->first();

        $product = Product::where('slug', $slug)
            ->with(['category', 'brand'])
            ->first();

        return view('user.shop.detail', compact('product', 'cart', 'wishList'));
    }
}
