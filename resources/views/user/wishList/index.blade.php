@extends('layouts.app')

@section('content')

    <section class="bg-white border-b border-gray-100 py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">My Wishlist</h1>
            <p class="text-gray-500">Manage your favorite items and add them to cart anytime.</p>
        </div>
    </section>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if($items->isNotEmpty())
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div class="flex gap-3">
                    <button
                        class="flex items-center gap-2 text-red-600 hover:bg-red-50 border border-red-200 px-4 py-2 rounded transition text-sm">
                        <i class="fa-regular fa-trash-can"></i>
                        Clear All
                    </button>
                </div>
            </div>
        @endif

        <div id="wishlist-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @if($items->isEmpty())

                <div id="empty-state" class="flex-col items-center justify-center py-20 text-center">

                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                        Your wishlist is empty
                    </h2>

                    <p class="text-gray-500 mb-8 max-w-md">
                        You don't have any items in your wishlist yet. Start exploring and find something you love!
                    </p>

                    <a href="{{ route('shop.index') }}"
                        class="bg-primary text-white px-8 py-3 rounded font-bold hover:bg-gray-800 transition shadow-lg">
                        Continue Shopping
                    </a>
                </div>

            @else

                @foreach ($items as $item)
                    <div
                        class="wishlist-item bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden group flex flex-col relative">

                        <form action="{{ route('wishlist.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">

                            <button type="submit"
                                class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-white shadow-sm text-gray-400 hover:text-red-500 hover:shadow-md transition flex items-center justify-center">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>

                        @if ($item->product->image)
                            <div class="relative aspect-square bg-gray-100 overflow-hidden">
                                <img src="{{ asset('assets/upload/product/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        @endif

                        <div class="p-4 flex flex-col flex-grow">

                            <div class="flex-grow">
                                <h3 class="font-bold text-gray-900 text-lg mb-1">
                                    {{ $item->product->name }}
                                </h3>

                                <p class="text-accent font-medium mb-2">
                                    @if ($item->product->sale_price)
                                        <s>${{ $item->product->price }}</s>
                                        ${{ $item->product->sale_price }}
                                    @else
                                        ${{ $item->product->price }}
                                    @endif
                                </p>

                                @if ($item->product->stock > 0)

                                    <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">
                                        In Stock
                                    </span>

                                @else

                                    <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded">
                                        Out of Stock
                                    </span>

                                @endif

                            </div>

                            @if ($cart->hasProduct($item->product_id))

                                <a href="{{ route('cart.index') }}"
                                    class="mt-4 w-full bg-primary text-white py-3 rounded font-medium hover:bg-gray-800 transition shadow-sm hover:shadow flex items-center justify-center gap-2">
                                    View Cart
                                </a>

                            @else

                                @if ($item->product->stock > 0)

                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <input type="hidden" name="quantity" value="1">

                                        <button type="submit"
                                            class="mt-4 w-full bg-primary text-white py-3 rounded font-medium hover:bg-gray-800 transition shadow-sm hover:shadow flex items-center justify-center gap-2"
                                            data-aside="cartDrawer">
                                            Add to Cart
                                        </button>
                                    </form>

                                @else

                                    <button
                                        class="mt-4 w-full bg-gray-300 text-gray-600 py-3 rounded font-medium cursor-not-allowed flex items-center justify-center gap-2"
                                        disabled>
                                        Out of Stock
                                    </button>

                                @endif

                            @endif

                        </div>
                    </div>
                @endforeach

            @endif

        </div>

    </div>

@endsection

@push('scripts')
    <script></script>
@endpush