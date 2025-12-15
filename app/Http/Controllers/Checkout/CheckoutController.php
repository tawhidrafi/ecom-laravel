<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Cart\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function index(Cart $cart, CartService $cartService)
    {
        $summary = $cartService->summary();

        return view('checkout.index', compact('cart', 'summary'));
    }
}
