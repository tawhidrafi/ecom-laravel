<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $summary = $this->cart->summary();

        $cart = $this->cart->getOrCreateCart();

        return view('cart.index', compact('summary', 'cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $quantity = $request->input('quantity', 1);

        $cart = $this->cart->add((int) $request->product_id, $quantity);

        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = $this->cart->update((int) $request->product_id, (int) $request->quantity);

        return redirect()->back()->with('success', 'Cart updated');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $cart = $this->cart->remove((int) $request->product_id);

        return redirect()->back()->with('success', 'Item removed');
    }

    public function clear()
    {
        $this->cart->clear();

        return redirect()->back()->with('success', 'Cart cleared');
    }
}
