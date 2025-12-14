<?php

namespace App\Services;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function getOrCreateCart(): Cart
    {
        $cart = $this->user->cart()->first();

        if (!$cart) {
            $cart = $this->user->cart()->create();
        }

        $cart->load('items');

        return $cart;
    }

    public function add(int $productId, int $quantity = 1): Cart
    {
        $product = Product::findOrFail($productId);

        if ($quantity < 1) {
            $quantity = 1;
        }

        $cart = $this->getOrCreateCart();

        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $newQty = $item->quantity + $quantity;

            $item->update(['quantity' => $newQty]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->sale_price ?? $product->price
            ]);
        }

        return $cart->fresh('items');
    }

    public function update(int $productId, int $quantity): Cart
    {
        $cart = $this->getOrCreateCart();

        $item = $cart->items()->where('product_id', $productId)->firstOrFail();

        if ($quantity <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => $quantity]);
        }

        return $cart->fresh('items');
    }

    public function remove(int $productId): Cart
    {
        $cart = $this->getOrCreateCart();

        $cart->items()->where('product_id', $productId)->delete();

        return $cart->fresh('items');
    }

    public function clear(): void
    {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();
    }

    public function summary(): array
    {
        $cart = $this->getOrCreateCart();

        $subtotal = (float) $cart->total;
        $discount = 0;

        $coupon = $cart->coupon;

        if ($coupon) {
            if ($coupon->expiry_date && \Carbon\Carbon::parse($coupon->expiry_date)->isPast()) {
                $coupon = null;
            } else if ($subtotal < (float) $coupon->min_purchase) {
                $coupon = null;
            } else {
                if ($coupon->type === 'fixed') {
                    $discount = $coupon->amount;
                }

                if ($coupon->type === 'percentage') {
                    $discount = $subtotal * ($coupon->amount / 100);
                }
            }
        }

        $discount = min($discount, $subtotal);

        $total = $subtotal - $discount;

        return [
            'subtotal' => (float) $subtotal,
            'discount' => (float) $discount,
            'total' => (float) $total,
            'coupon' => $coupon
        ];
    }
}