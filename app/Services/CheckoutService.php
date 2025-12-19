<?php

namespace App\Services;

use App\Models\Checkout\Order;
use DB;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    protected $user;
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->user = Auth::user();
        $this->cartService = $cartService;
    }

    public function checkout($data)
    {
        $summary = $this->cartService->summary();
        $cart = $this->cartService->getOrCreateCart();

        return DB::transaction(function () use ($data, $summary, $cart) {
            // create Order
            $order = new Order();
            $order->user_id = $this->user->id;
            $order->phone = $data['phone'];
            $order->coupon_id = $cart->coupon_id;

            $order->subtotal = $summary['subtotal'];
            $order->tax = 0;
            $order->shipping = 0;
            $order->discount = $summary['discount'];
            $order->total = $summary['total'];

            $order->address_id = null;
            $order->address = $data['address'];
            $order->city = $data['city'];
            $order->zip = $data['zip'];
            $order->country = $data['country'];

            $order->status = 'pending';
            $order->save();

            // create Order Items
            foreach ($cart->items as $item) {
                $product = $item->product()->lockForUpdate()->first();

                $product->decrement('stock', $item->quantity);

                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->quantity * $item->price,
                ]);
            }

            // transaction 
            $this->user->transactions()->create([
                'order_id' => $order->id,
                'method' => $data['method'],
                'amount' => $summary['total'],
            ]);

            // clear cart
            $this->cartService->clear();

            return $order;
        });
    }
}