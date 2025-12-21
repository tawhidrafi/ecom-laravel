<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    // index
    public function index()
    {
        $orders = auth()->user()->orders()->paginate(10);
        return view('user.order.index', compact('orders'));
    }

    // show
    public function show(\App\Models\User\Order $order)
    {
        return view('user.order.detail', compact('order'));
    }

    // cancel order 
    public function cancel(\App\Models\User\Order $order)
    {
        $order->cancelled_date = now();
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('user.orders.show', $order)->with('success', 'Order cancelled successfully.');
    }
}
