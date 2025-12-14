<?php

namespace App\Services;

use App\Models\Cart\Cart;
use App\Models\Coupon\Coupon;
use Auth;

class CouponService
{
    public function applyCoupon($code)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return ['success' => false, 'message' => 'Invalid coupon code'];
        }

        if ($coupon->expiry_date && \Carbon\Carbon::parse($coupon->expiry_date)->isPast()) {
            return ['success' => false, 'message' => 'Coupon has expired'];
        }

        if ($cart->total < (float) $coupon->min_purchase) {
            return ['success' => false, 'message' => 'Minimum purchase not met'];
        }

        $cart->coupon_id = $coupon->id;
        $cart->save();
        $cart->refresh();

        return ['success' => true, 'message' => 'Coupon applied successfully'];
    }

    // remove coupon
    public function removeCoupon()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        $cart->coupon_id = null;
        $cart->save();
        $cart->refresh();
    }
}