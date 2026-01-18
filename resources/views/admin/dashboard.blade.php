@extends('layouts.admin-app')

@section('content')

    <div class="space-y-8">

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

            <!-- Card -->
            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <span class="text-blue-600">🛒</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-semibold">{{ $totalOrders }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="text-green-600">$</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Amount</p>
                    <p class="text-2xl font-semibold">${{ $totalAmount }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <span class="text-yellow-600">⏳</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-2xl font-semibold">{{ $pendingOrders }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <span class="text-yellow-600">$</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pending Amount</p>
                    <p class="text-2xl font-semibold">${{ $pendingAmount }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="text-green-600">✅</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Delivered Orders</p>
                    <p class="text-2xl font-semibold">{{ $deliveredOrders }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="text-green-600">$</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Delivered Amount</p>
                    <p class="text-2xl font-semibold">${{ $deliveredAmount }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <span class="text-red-600">✖</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Canceled Orders</p>
                    <p class="text-2xl font-semibold">{{ $canceledOrders }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <span class="text-red-600">$</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Canceled Amount</p>
                    <p class="text-2xl font-semibold">${{ $canceledAmount }}</p>
                </div>
            </div>

        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow">

            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:underline">
                    View all
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">Order</th>
                            <th class="px-4 py-3 text-left">Customer</th>
                            <th class="px-4 py-3 text-left">Phone</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Date</th>
                            <th class="px-4 py-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">

                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">#{{ $order->id }}</td>
                                <td class="px-4 py-3">{{ $order->user->name }}</td>
                                <td class="px-4 py-3">{{ $order->phone }}</td>
                                <td class="px-4 py-3 text-right">${{ $order->total }}</td>

                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-1 rounded text-xs font-medium
                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                                            @elseif($order->status === 'delivered') bg-green-100 text-green-700
                                            @else bg-red-100 text-red-700
                                            @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="text-blue-600 hover:underline">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>

@endsection