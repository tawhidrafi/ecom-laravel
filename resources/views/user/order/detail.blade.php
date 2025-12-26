@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <p class="text-gray-500 text-sm mt-1">Placed on <span id="order-date">{{ $order->created_at }}</span></p>
            </div>
            <div class="flex gap-3">
                <button
                    class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded text-sm font-medium hover:bg-gray-50 transition shadow-sm">
                    <i class="fa-solid fa-file-invoice mr-2"></i> Download Invoice
                </button>
                <button
                    class="bg-primary text-white px-4 py-2 rounded text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                    <i class="fa-solid fa-truck-fast mr-2"></i> Track Package
                </button>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100 mb-8 overflow-x-auto">
            <div class="flex items-center justify-between min-w-[600px] md:min-w-0">

                <div class="flex flex-col items-center relative flex-1">
                    <div
                        class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm z-10 border-4 border-white shadow-sm">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="absolute top-5 left-[calc(50%+20px)] w-full h-1 bg-green-500 -z-0"></div>
                    <div class="mt-3 text-center">
                        <span class="block text-sm font-bold text-gray-900">Order Placed</span>
                        <span class="text-xs text-gray-500">{{ $order->created_at }}</span>
                    </div>
                </div>

                <div class="flex flex-col items-center relative flex-1">
                    <div
                        class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm z-10 border-4 border-white shadow-sm">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="absolute top-5 left-[calc(50%+20px)] w-full h-1 bg-green-500 -z-0"></div>
                    <div class="mt-3 text-center">
                        <span class="block text-sm font-bold text-gray-900">Processing</span>
                        <span class="text-xs text-gray-500">--</span>
                    </div>
                </div>

                <div class="flex flex-col items-center relative flex-1">
                    <div class="absolute top-5 left-[-50%] w-[calc(100%+20px)] h-1 bg-green-500 -z-0"></div>
                    <div class="absolute top-5 left-[calc(50%+20px)] w-full h-1 bg-gray-200 -z-0"></div>
                    <div
                        class="w-10 h-10 bg-accent text-white rounded-full flex items-center justify-center font-bold text-sm z-10 border-4 border-white shadow-sm animate-pulse">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <span class="block text-sm font-bold text-primary">In Transit</span>
                        <span class="text-xs text-accent font-medium">Current Status</span>
                    </div>
                </div>

                <div class="flex flex-col items-center relative flex-1">
                    <div
                        class="w-10 h-10 bg-white border-2 border-gray-200 text-gray-300 rounded-full flex items-center justify-center font-bold text-sm z-10">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <span class="block text-sm font-medium text-gray-400">Delivered</span>
                        <span class="text-xs text-gray-400">{{ $order->delivery_date }}</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">Order Items</h2>

                    <div class="space-y-6">
                        @foreach ($order->orderItems as $item)
                            <div class="flex gap-4 border-b border-gray-50 pb-6 last:border-0 last:pb-0">
                                <div class="w-20 h-20 bg-gray-100 rounded border border-gray-200 overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('assets/upload/product') . '/' . $item->product->image }}" alt="Product"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $item->product->name }}</h4>
                                        </div>
                                        <p class="font-bold text-gray-900">${{ $item->price }}</p>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                        <button
                                            class="text-sm font-medium text-accent hover:underline hover:text-primary transition">Buy
                                            Again</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Shipping Information</h2>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 flex-shrink-0">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $order->user->name }}</p>
                            <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                                {{ $order->address }}<br>
                                {{ $order->city }}, {{ $order->zip }}<br>
                                {{ $order->country }}
                            </p>
                            <p class="text-gray-600 text-sm mt-2">
                                <i class="fa-solid fa-phone text-xs mr-1"></i> {{ $order->phone }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Payment Summary</h2>
                    <div class="space-y-3 text-sm mb-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ $order->total }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span>Free Shipping</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span>${{ $order->tax }}</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 my-4"></div>
                    <div class="flex justify-between items-center text-lg">
                        <span class="font-bold text-gray-900">Total</span>
                        <span class="font-bold text-2xl text-primary">${{ $order->total }}</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Payment Method</h2>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded border border-gray-100">
                        <i class="fa-brands fa-cc-visa text-2xl text-gray-700"></i>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $order->transaction->method }}</p>
                            <p class="text-xs text-gray-500">Paid on {{ $order->transaction->updated_at }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-accent/10 p-6 rounded-lg border border-accent/20 text-center">
                    <i class="fa-solid fa-headset text-2xl text-accent mb-2"></i>
                    <h3 class="font-bold text-gray-900">Need Help?</h3>
                    <p class="text-sm text-gray-600 mt-1 mb-4">Have questions about this order? Our team is here to
                        assist.</p>
                    <a href="#"
                        class="inline-block bg-white text-accent border border-accent px-4 py-2 rounded text-sm font-bold hover:bg-accent hover:text-white transition">Contact
                        Support</a>
                </div>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script></script>
@endpush