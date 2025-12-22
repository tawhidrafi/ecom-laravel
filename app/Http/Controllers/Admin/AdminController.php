<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    // settings
    public function settings()
    {
        return view('admin.settings');
    }

    // settings update
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:admins,email,' . $admin->id,
            // 'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
