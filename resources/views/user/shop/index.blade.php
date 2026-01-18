@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100 py-4">
        <div class="container mx-auto px-4">
            <p class="text-sm text-gray-500">
                <a href="{{ url('/') }}" class="hover:text-primary">Home</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">Shop</span>
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Sidebar -->
            <aside id="sidebar"
                class="fixed inset-y-0 left-0 z-30 w-80 bg-white shadow-xl transform -translate-x-full lg:static lg:transform-none lg:block lg:shadow-none lg:w-1/4 lg:bg-transparent sidebar-transition h-full overflow-y-auto">
                <div class="p-6 lg:p-0 h-full">

                    <!-- Search -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-900 mb-2">Search</label>
                        <div class="relative">
                            <input type="text" placeholder="Search products..."
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent py-2 pl-10 pr-4 border">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Categories (static for now) -->
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-900 mb-4">Categories</h3>
                        <div class="space-y-3">
                            @foreach (['Living Room', 'Lighting', 'Decor'] as $category)
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input type="checkbox" class="hidden custom-checkbox">
                                    <div
                                        class="w-5 h-5 border-2 border-gray-300 rounded flex items-center justify-center transition group-hover:border-accent">
                                        <svg class="w-3 h-3 text-white hidden pointer-events-none" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-600 group-hover:text-primary">
                                        {{ $category }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-900 mb-4">Price Range</h3>
                        <div class="space-y-3">
                            @foreach (['$0 - $50', '$50 - $100', '$100+'] as $range)
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input type="checkbox" class="hidden custom-checkbox">
                                    <div
                                        class="w-5 h-5 border-2 border-gray-300 rounded flex items-center justify-center transition group-hover:border-accent">
                                        <svg class="w-3 h-3 text-white hidden pointer-events-none" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-600 group-hover:text-primary">
                                        {{ $range }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            {{-- <section class="w-full lg:w-3/4"> --}}
                <section class="w-full">

                    <!-- Toolbar -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100">

                        <span class="text-sm text-gray-600">
                            Showing
                            <strong>{{ $products->firstItem() }}</strong> -
                            <strong>{{ $products->lastItem() }}</strong>
                            of
                            <strong>{{ $products->total() }}</strong>
                            results
                        </span>

                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <form method="GET" action="{{ route('shop.index') }}">
                                    <select name="sort" onchange="this.form.submit()"
                                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 py-2 pl-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-accent text-sm font-medium">
                                        <option value="">Default</option>
                                        <option value="popular">Popular</option>
                                        <option value="newest">Newest</option>
                                        <option value="low_price">Low Price</option>
                                        <option value="high_price">High Price</option>
                                    </select>
                                </form>
                                <div
                                    class="pointer-events-none absolute inset-y-1 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @forelse ($products as $product)
                            <div
                                class="group relative bg-white rounded-lg overflow-hidden border border-gray-100 hover:shadow-lg transition duration-300">

                                <div class="relative overflow-hidden bg-gray-200 h-56 sm:h-64">
                                    <img src="{{ asset('assets/upload/product') . '/' . $product->image }}"
                                        alt="{{ $product->name }}"
                                        class="h-full w-full object-cover object-center group-hover:scale-105 transition duration-500">

                                    <div
                                        class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition duration-300 flex justify-center gap-3">

                                        @auth
                                            @if($cart && $cart->hasProduct($product->id))
                                                <a href="{{ route('cart.index') }}"
                                                    class="bg-white text-primary hover:bg-accent hover:text-white p-3 rounded-full shadow-lg transition">
                                                    View Cart
                                                </a>
                                            @else
                                                <form method="POST" action="{{ route('cart.add') }}">
                                                    @csrf

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">

                                                    <button type="submit"
                                                        class="bg-white text-primary hover:bg-accent hover:text-white p-3 rounded-full shadow-lg transition">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="bg-white text-primary hover:bg-accent hover:text-white p-3 rounded-full shadow-lg transition">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </a>
                                        @endauth

                                        <a href="{{ route('shop.show', $product->slug) }}"
                                            class="bg-white text-primary hover:bg-accent hover:text-white p-3 rounded-full shadow-lg transition">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>

                                    @auth
                                        @if($wishList && $wishList->hasProduct($product->id))
                                            <a href="{{ route('wishlist.index') }}"
                                                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 bg-white/50 hover:bg-white p-2 rounded-full transition backdrop-blur-sm">
                                                View Wishlist
                                            </a>
                                        @else
                                            <form method="POST" action="{{ route('wishlist.add') }}">
                                                @csrf

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                <button type="submit"
                                                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500 bg-white/50 hover:bg-white p-2 rounded-full transition backdrop-blur-sm">
                                                    <i class="fa-solid fa-heart"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 bg-white/50 hover:bg-white p-2 rounded-full transition backdrop-blur-sm">
                                            <i class="fa-solid fa-heart"></i>
                                        </a>
                                    @endauth
                                </div>

                                <div class="p-4">
                                    <h3 class="text-sm font-medium text-gray-700 hover:text-accent">
                                        {{ $product->name }}
                                    </h3>

                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-lg font-bold text-gray-900">
                                            ${{ number_format($product->price, 2) }}
                                        </p>

                                        <div class="flex text-yellow-400 text-xs">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                    </div>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $product->category?->name }} · {{ $product->brand?->name }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-500">
                                No products available.
                            </div>
                        @endforelse

                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $products->links() }}
                    </div>

                </section>
        </div>
    </div>
@endsection