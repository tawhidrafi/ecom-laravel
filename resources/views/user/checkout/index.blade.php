@extends('layouts.app')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                <div class="lg:col-span-8 space-y-8">

                    <h1 class="text-2xl font-bold text-gray-900">Checkout</h1>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <!-- Shipping Address -->
                        <section class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Shipping Address</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" disabled value="{{ auth()->user()->name }}" placeholder="Full name"
                                        class="w-full border-gray-300 rounded-md py-2 px-3 border bg-gray-100">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                                    <input type="text" name="phone" required value="{{ auth()->user()->phone ?? '' }}"
                                        placeholder="Phone" class="w-full border-gray-300 rounded-md py-2 px-3 border">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                                    <input type="text" name="address" required placeholder="Address"
                                        class="w-full border-gray-300 rounded-md py-2 px-3 border">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                                    <input type="text" name="city" required placeholder="City"
                                        class="w-full border-gray-300 rounded-md py-2 px-3 border">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ZIP *</label>
                                    <input type="text" name="zip" required placeholder="Zip"
                                        class="w-full border-gray-300 rounded-md py-2 px-3 border">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                                    <input type="text" name="country" required placeholder="Country"
                                        class="w-full border-gray-300 rounded-md py-2 px-3 border">
                                </div>

                            </div>
                        </section>

                        <!-- Payment Method -->
                        <section class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h2>

                            <div class="space-y-3">

                                <label class="block border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="method" value="bank" required class="mr-2">
                                    Bank Transfer
                                </label>

                                <label class="block border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="method" value="bkash/nagad" class="mr-2">
                                    MFS (Bkash / Nagad)
                                </label>

                                <label class="block border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="method" value="cod" class="mr-2">
                                    Cash on Delivery
                                </label>

                            </div>

                            <button type="submit" class="w-full mt-6 bg-primary text-white py-4 rounded-lg font-bold text-lg
                                       hover:bg-gray-800 transition shadow-lg active:scale-95">
                                Complete Order
                            </button>
                        </section>
                    </form>
                </div>

                <div class="lg:col-span-4">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        <!-- Items List -->
                        <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                            @foreach ($cart->items as $item)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-500">Qty : {{ $item->quantity }}</p>
                                    <p class="text-sm font-bold text-gray-900">${{ $item->subtotal }}</p>
                                </div>
                            @endforeach
                        </div>

                        <hr class="border-gray-100 mb-6">

                        <!-- Totals -->
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-bold text-gray-900">${{ $cart->total }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="font-medium">Free Shipping</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Discount</span>
                                <span class="font-medium">${{ $summary['discount'] }}</span>
                            </div>
                        </div>

                        <hr class="border-gray-100 my-6">

                        <div class="flex justify-between items-center text-lg mb-6">
                            <span class="font-bold text-gray-900">Total</span>
                            <span class="font-bold text-2xl text-accent">${{ $summary['total'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush