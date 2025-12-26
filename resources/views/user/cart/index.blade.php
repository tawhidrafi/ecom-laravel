@extends('layouts.app')

@section('content')

    <section class="bg-white border-b border-gray-100 py-6">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Shopping Cart</h1>
            <span class="text-gray-500"><span id="item-count-badge">{{ $cart->items->count() }}</span> items</span>
        </div>
    </section>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-8 space-y-4" id="cart-items-container">

                @if($cart->items->isEmpty())

                    <div id="empty-cart-message"
                        class="flex-col items-center justify-center py-20 text-center bg-white rounded-lg shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                        <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
                        <a href="{{ route('shop.index') }}"
                            class="bg-primary text-white px-8 py-3 rounded font-bold hover:bg-gray-800 transition shadow-lg">Start
                            Shopping</a>
                    </div>

                @else

                    @foreach($cart->items as $item)

                        <div
                            class="cart-item bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col sm:flex-row gap-6 items-start sm:items-center">

                            <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden">
                                <img src="{{ asset('assets/upload/product') . '/' . $item->product->image }}" alt="Product"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="flex-1 w-full">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $item->product->name }}</h3>
                                    </div>

                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <button type="submit"
                                            class="text-gray-400 hover:text-red-500 transition sm:block">Remove</button>
                                    </form>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mt-4 gap-4">

                                    <div class="text-lg font-bold text-gray-900">
                                        ${{ number_format($item->price, 2) }}
                                    </div>

                                    <form action="{{ route('cart.update') }}" method="POST" class="inline-flex items-center gap-2">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity }}" class="qty-hidden">

                                        <div class="flex items-center border border-gray-300 rounded-md">
                                            <button type="button" onclick="updateQty(this, -1)"
                                                class="px-3 py-1 text-gray-600 hover:bg-gray-100 transition">
                                                <i class="fa-solid fa-minus text-xs"></i>
                                            </button>

                                            <input type="number" readonly
                                                class="w-10 text-center border-none focus:ring-0 text-gray-900 font-medium qty-input"
                                                value="{{ $item->quantity }}">

                                            <button type="button" onclick="updateQty(this, 1)"
                                                class="px-3 py-1 text-gray-600 hover:bg-gray-100 transition">
                                                <i class="fa-solid fa-plus text-xs"></i>
                                            </button>
                                        </div>

                                        <button type="submit"
                                            class="px-2 py-1 rounded-md border border-gray-300 text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition">
                                            Update
                                        </button>
                                    </form>

                                    <div class="text-lg font-bold text-gray-900 item-total">
                                        ${{ number_format($item->subtotal, 2) }}
                                    </div>
                                </div>

                            </div>

                            <div class="w-full flex justify-end sm:hidden">

                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">

                                    <button type="submit" class="text-red-500 font-medium text-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                    @if ($summary['coupon'])
                        <form action="{{ route('coupon.remove') }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')

                            <input type="text" value="{{ $summary['coupon']->code }}"
                                class="w-full border border-gray-300 rounded p-2 text-sm uppercase" disabled>

                            <button type="submit"
                                class="mt-2 w-full bg-red-100 text-red-600 py-2 rounded text-sm font-semibold hover:bg-red-200 transition">
                                Remove Coupon
                            </button>
                        </form>
                    @else
                        <form action="{{ route('coupon.apply') }}" method="POST" class="mt-2">
                            @csrf

                            <input type="text" name="code" placeholder="Try SAVE10"
                                class="w-full border border-gray-300 rounded p-2 text-sm uppercase">

                            <button type="submit"
                                class="mt-2 w-full bg-gray-100 text-gray-700 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">
                                Apply Coupon
                            </button>
                        </form>
                    @endif

                    <hr class="border-gray-100 mb-6">

                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900"
                                id="subtotal-display">${{ number_format($summary['subtotal'], 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping Estimate</span>
                            <span class="font-medium" id="shipping-display">Free Shipping</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>TAX /VAT</span>
                            <span class="font-medium" id="tax-display">$0.00</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Discount</span>
                            <span class="font-bold" id="discount-display">-
                                ${{ number_format($summary['discount'], 2) }}</span>
                        </div>
                    </div>

                    <hr class="border-gray-100 my-6">

                    <div class="flex justify-between items-center text-lg mb-8">
                        <span class="font-bold text-gray-900">Order Total</span>
                        <span class="font-bold text-2xl text-accent"
                            id="grand-total-display">${{ number_format($summary['total'], 2) }}</span>
                    </div>

                    <button
                        class="w-full bg-primary text-white py-4 rounded-lg font-bold text-lg hover:bg-gray-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                        <a href="{{ route('checkout.index') }}">Checkout</a>
                    </button>

                    <div class="mt-4 text-center">
                        <a href="{{ route('shop.index') }}"
                            class="text-sm text-gray-500 hover:text-primary underline">Continue Shopping</a>
                    </div>

                    <div class="mt-6 flex justify-center gap-2 opacity-50 grayscale">
                        <i class="fa-brands fa-cc-visa text-2xl"></i>
                        <i class="fa-brands fa-cc-mastercard text-2xl"></i>
                        <i class="fa-brands fa-cc-paypal text-2xl"></i>
                        <i class="fa-brands fa-cc-apple-pay text-2xl"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function updateQty(button, change) {
            const form = button.closest('form');
            if (!form) return;

            const visibleInput = form.querySelector('.qty-input');
            const hiddenInput = form.querySelector('.qty-hidden');

            let qty = parseInt(visibleInput.value, 10) || 1;
            qty += change;

            if (qty < 1) qty = 1;

            visibleInput.value = qty;
            hiddenInput.value = qty;
        }
    </script>
@endpush