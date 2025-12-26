@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 text-center max-w-3xl mx-auto">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-check text-4xl text-green-600"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Thank You!</h1>
            <p class="text-gray-600 text-lg">Your order has been placed successfully.</p>

            <div
                class="mt-8 bg-gray-50 rounded-lg p-4 flex flex-col md:flex-row justify-center items-center gap-4 md:gap-12">
                <div>
                    <span class="block text-xs text-gray-500 uppercase tracking-wide font-semibold">Order
                        Number</span>
                    <span class="block text-xl font-bold text-gray-900">#{{ $order->id }}</span>
                </div>
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <div>
                    <span class="block text-xs text-gray-500 uppercase tracking-wide font-semibold">Date</span>
                    <span id="order-date"
                        class="block text-xl font-bold text-gray-900">{{ $order->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <div>
                    <span class="block text-xs text-gray-500 uppercase tracking-wide font-semibold">Total</span>
                    <span class="block text-xl font-bold text-gray-900">${{ $order->total }}</span>
                </div>
            </div>

            <p class="mt-6 text-sm text-gray-500">
                We've sent a confirmation email to <span class="font-medium text-gray-900">{{ $order->user->email }}</span>
                with
                your order details.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-truck-fast text-accent"></i> Shipping Information
                    </h2>
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold text-gray-900">{{ $order->user->name }}</p>
                            <p class="text-gray-900">Contact No: {{ $order->phone }}</p>
                            <p class="text-gray-600 text-sm mt-1">
                                {{ $order->address }}<br>
                                {{ $order->city }}, {{ $order->zip }}<br>
                                {{ $order->country }}
                            </p>
                        </div>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Order Items</h2>

                    <div class="space-y-6">
                        @foreach ($order->orderItems as $item)
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $item->product->name }}</h4>
                                    </div>
                                    <p class="font-bold text-gray-900">${{ number_format($item->price, 2) }}</p>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Qty: {{ $item->quantity }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">

                <!-- Payment Summary -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Payment Summary</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ $order->subtotal }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span>Free shipping</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>TAX / VAT</span>
                            <span>${{ $order->tax }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Discount</span>
                            <span>${{ $order->discount }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 mt-4 pt-4 flex justify-between items-center">
                        <span class="font-bold text-gray-900">Total Paid</span>
                        <span class="font-bold text-xl text-accent">${{ $order->total }}</span>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <span class="block text-xs text-gray-500 uppercase tracking-wide font-semibold mb-1">Payment
                            Method</span>
                        <div class="flex items-center gap-2 text-gray-900 font-medium">
                            @if ($order->transaction->method === 'bank')
                                {{ 'Bank transfer' }}
                            @elseif ($order->transaction->method === 'cod')
                                {{'Cash on delivery'}}
                            @else
                                {{'Bkash/Nagad'}}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-2">Need Help?</h3>
                    <p class="text-sm text-gray-600 mb-4">If you have any questions regarding your order, please
                        feel free to contact our support team.</p>
                    <a href="{{ route('contact.index') }}"
                        class="inline-flex items-center justify-center w-full bg-white border border-gray-300 text-gray-700 py-2 rounded text-sm font-medium hover:bg-gray-50 transition">
                        <i class="fa-solid fa-headset mr-2"></i> Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush