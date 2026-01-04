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
    public function shop(Request $request)
    {
        $user = Auth::user();

        $cart = optional($user)->cart()?->with(['items', 'items.product'])->first();

        $wishList = optional($user)->wishList()?->with(['items', 'items.product'])->first();

        $sort = $request->query('sort');

        $products = Product::query()
            ->when($sort === 'popular', function ($q) {
                $q->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
                    ->select('products.*')
                    ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
                    ->groupBy('products.id')
                    ->orderByDesc('total_sold');
            })
            ->when(
                $sort === 'newest',
                fn($q) =>
                $q->orderBy('created_at', 'desc')
            )
            ->when(
                $sort === 'low_price',
                fn($q) =>
                $q->orderBy('price', 'asc')
            )
            ->when(
                $sort === 'high_price',
                fn($q) =>
                $q->orderBy('price', 'desc')
            )
            ->paginate(12)
            ->withQueryString();

        return view('user.shop.index', compact('products', 'sort', 'cart', 'wishList'));
    }

    // show
    public function show($slug)
    {
        $user = Auth::user();

        $cart = optional($user)->cart()?->with(['items', 'items.product'])->first();

        $wishList = optional($user)->wishList()?->with(['items', 'items.product'])->first();

        $product = Product::where('slug', $slug)->firstOrFail();

        $product->load([
            'category',
            'brand',
            'reviews.user' => fn($q) => $q->select('id', 'name')
        ]);

        return view('user.shop.detail', compact('product', 'cart', 'wishList'));
    }
}
