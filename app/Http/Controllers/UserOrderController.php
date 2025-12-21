<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    // index
    public function index()
    {
        $orders = auth()->user()->orders()->paginate(10);
        return view('order.index', compact('orders'));
    }

    // show
    public function show(\App\Models\Checkout\Order $order)
    {
        return view('order.detail', compact('order'));
    }

    // cancel order 
    public function cancel(\App\Models\Checkout\Order $order)
    {
        $order->cancelled_date = now();
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('user.orders.show', $order)->with('success', 'Order cancelled successfully.');
    }
}
