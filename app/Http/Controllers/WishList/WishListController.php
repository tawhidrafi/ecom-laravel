<?php

namespace App\Http\Controllers\WishList;

use App\Http\Controllers\Controller;
use App\Services\WishListService;
use Auth;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    //
    protected $wishList;
    public function __construct(WishListService $wishList)
    {
        $this->wishList = $wishList;
    }

    public function index()
    {
        //
        $wishList = $this->wishList->getOrCreateWishList();
        $cart = auth()->user()->cart()->with('items')->first();

        return view('wishList.index', ['wishList' => $wishList, 'items' => $wishList->items, 'cart' => $cart]);
    }

    public function add(Request $request)
    {
        //
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $this->wishList->add((int) $request->product_id);

        return redirect()
            ->back()
            ->with('success', 'Product added to wishlist');
    }

    public function remove(Request $request)
    {
        //
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $this->wishList->remove((int) $request->product_id);

        return redirect()
            ->back()
            ->with('success', 'Item removed');
    }

    public function clear(Request $request)
    {
        //
        $this->wishList->clear();

        return redirect()
            ->back()
            ->with('success', 'Wishlist cleared');
    }
}
