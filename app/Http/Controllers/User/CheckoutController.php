<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Order;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    protected $cartService;
    protected $user;
    protected $checkoutService;
    public function __construct(CartService $cartService, CheckoutService $checkoutService)
    {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
        $this->user = auth()->user();
    }
    public function index()
    {
        $cart = $this->cartService->getOrCreateCart();
        $summary = $this->cartService->summary();

        return view('user.checkout.index', compact('summary', 'cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'method' => 'string|in:bank,cod,bkash/nagad',
        ]);

        try {
            $order = $this->checkoutService->checkout($validated);

            return redirect()
                ->route('checkout.confirmation', $order)
                ->with('success', 'Order placed successfully');

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'checkout' => $e->getMessage(),
                ]);
        }
    }

    // confirmation
    public function confirmation(Order $order)
    {
        return view('user.checkout.confirmation', compact('order'));
    }
}
