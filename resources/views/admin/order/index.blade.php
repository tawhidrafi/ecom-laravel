@extends('layouts.admin-app')

@section('content')
    <div class="p-6 max-w-full mx-auto">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Orders</h2>
                <p class="text-sm text-gray-500">Manage all customer orders</p>
            </div>
        </div>

        <!-- Search -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
            <form method="GET" class="flex w-full md:w-1/3">
                <input type="text" name="search" placeholder="Search orders..."
                    class="flex-grow px-4 py-2 border rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ request('search') }}">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700">
                    Search
                </button>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OrderNo
                        </th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                        </th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Phone
                        </th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subtotal</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tax
                        </th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                        </th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Order
                            Date</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                            Items</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Delivered On</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->id }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->user->name }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->phone }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->subtotal }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->tax }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->total }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->orderItems->count() }}</td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700">{{ $order->delivery_date ?? 'Pending' }}
                            </td>
                            <td class="px-4 py-2 text-sm text-center text-gray-700 flex justify-center gap-2">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-4 py-2 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-end">
            {{ $orders->links() }}
        </div>

    </div>
@endsection