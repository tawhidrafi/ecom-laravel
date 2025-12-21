<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout\Order;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id)->with(['orderItems.product', 'transaction'])->first();
        return view('admin.order.detail', compact('order'));
    }

    //
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'in:approve,reject',
        ]);

        $transactionStatus = $validated['status'] === 'approve' ? 'completed' : 'failed';

        $orderStatus = $validated['status'] === 'approve' ? 'confirmed' : 'cancelled';

        DB::transaction(function () use ($order, $request, $transactionStatus, $orderStatus) {
            $order->transaction()->update([
                'trx_id' => $request['trx_id'],
                'status' => $transactionStatus,
            ]);

            $order->update([
                'status' => $orderStatus,
            ]);
        });

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    public function updateDeliveryStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'in:processing,shipped,delivered',
        ]);

        $order->update([
            'status' => $validated['status'],
            'delivery_date' => $validated['status'] === 'delivered' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Delivery status updated successfully.');
    }
}
