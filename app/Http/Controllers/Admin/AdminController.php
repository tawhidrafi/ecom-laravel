<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // index
    public function index()
    {
        $orders = \App\Models\User\Order::latest()->paginate(10);

        $totalOrders = $orders->count();
        $totalAmount = $orders->sum('total');
        $pendingOrders = $orders->where('status', 'pending')->count();
        $pendingAmount = $orders->where('status', 'pending')->sum('total');
        $deliveredOrders = $orders->where('status', 'delivered')->count();
        $deliveredAmount = $orders->where('status', 'delivered')->sum('total');
        $canceledOrders = $orders->where('status', 'canceled')->count();
        $canceledAmount = $orders->where('status', 'canceled')->sum('total');

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalAmount',
            'pendingOrders',
            'pendingAmount',
            'deliveredOrders',
            'deliveredAmount',
            'canceledOrders',
            'canceledAmount',
            'orders'
        ));
    }
}
