@extends('layouts.admin-app')

@section('content')
    <div class="p-6 max-w-full mx-auto space-y-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Order Details</h2>
                <p class="text-sm text-gray-500">Order #{{ $order->id }}</p>
            </div>
            <a href="{{ route('admin.orders.index') }}"
                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800">Back</a>
        </div>

        <!-- Ordered Items -->
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-medium text-gray-700 mb-3">Ordered Items</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">SKU</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Brand</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($order->orderItems as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 flex items-center gap-2">
                                    <img src="{{ asset('assets/upload/product/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded">
                                    <span class="text-gray-700 font-medium">{{ $item->product->name }}</span>
                                </td>
                                <td class="px-4 py-2 text-center text-gray-700">{{ $item->price }}</td>
                                <td class="px-4 py-2 text-center text-gray-700">{{ $item->quantity }}</td>
                                <td class="px-4 py-2 text-center text-gray-700">{{ $item->product->SKU }}</td>
                                <td class="px-4 py-2 text-center text-gray-700">{{ $item->product->category->name }}</td>
                                <td class="px-4 py-2 text-center text-gray-700">{{ $item->product->brand->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-medium text-gray-700 mb-3">Shipping Address</h3>
            <div class="space-y-1 text-gray-700">
                <p>{{ $order->user->name }}</p>
                <p>{{ $order->address }}, {{ $order->city }}</p>
                <p>{{ $order->state ?? 'N/A' }} - {{ $order->zip }}</p>
                <p>{{ $order->country }}</p>
                <p>Mobile: {{ $order->phone }}</p>
            </div>
        </div>

        <!-- Transactions -->
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-medium text-gray-700 mb-3">Transactions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
                <div>
                    <p class="font-medium">Subtotal</p>
                    <p>{{ $order->subtotal }}</p>
                </div>
                <div>
                    <p class="font-medium">Tax</p>
                    <p>{{ $order->tax }}</p>
                </div>
                <div>
                    <p class="font-medium">Discount</p>
                    <p>{{ $order->discount }}</p>
                </div>
                <div>
                    <p class="font-medium">Total</p>
                    <p>{{ $order->total }}</p>
                </div>
                <div>
                    <p class="font-medium">Payment Mode</p>
                    <p>{{ $order->transaction->method }}</p>
                </div>
                <div>
                    <p class="font-medium">Status</p>
                    <p>{{ ucfirst($order->status) }}</p>
                </div>
                <div>
                    <p class="font-medium">Order Date</p>
                    <p>{{ $order->created_at->format('Y-m-d') }}</p>
                </div>
                <div>
                    <p class="font-medium">Delivered Date</p>
                    <p>{{ $order->delivery_date ?? 'Not delivered'}}</p>
                </div>
                <div>
                    <p class="font-medium">Canceled Date</p>
                    <p>{{ $order->cancelled_date ?? 'Not canceled' }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-medium text-gray-700 mb-3">Actions</h3>
            @if ($order->transaction && $order->transaction->status === 'pending' && $order->status !== 'cancelled')
                <form action="{{ route('admin.orders.update-payment-status', $order) }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    @csrf
                    @method('put')
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Trx/Ref Id</label>
                        <input type="text" name="trx_id" placeholder="Enter Id" class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Approve / Reject</label>
                        <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 border rounded">
                            <option>Select Any</option>
                            <option value="approve">Approve</option>
                            <option value="reject">Reject</option>
                        </select>
                    </div>
                </form>
            @else
                <p class="text-gray-700">Payment has been <strong>{{ $order->transaction->status }}</strong></p>
            @endif

            @if ($order->status !== 'delivered' && $order->status !== 'cancelled')
                <form action="{{ route('admin.orders.update-delivery-status', $order) }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @csrf
                    @method('put')
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Shipping Status</label>
                        <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 border rounded">
                            <option>Select Any</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>
                </form>
            @else
                <p class="text-gray-700 mt-2">Shipping Status: <strong>{{ $order->delivery_date ?? 'Not delivered' }}</strong>
                </p>
            @endif
        </div>

    </div>
@endsection