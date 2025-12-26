@extends('layouts.app')

@section('content')

    <section class="relative h-[600px] flex items-center bg-gray-100 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://picsum.photos/seed/interior99/1920/1080" alt="Modern Interior"
                class="w-full h-full object-cover opacity-90">
        </div>

        <div class="absolute inset-0 bg-black/20 z-10"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="max-w-2xl text-white">
                <span
                    class="inline-block py-1 px-3 border border-white/30 rounded-full text-xs font-semibold uppercase mb-4 backdrop-blur-sm">
                    New Collection
                </span>

                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Redefine Your Living Space
                </h1>

                <p class="text-lg md:text-xl text-gray-200 mb-8 font-light">
                    Discover minimalistic furniture crafted for comfort and designed to last.
                </p>

                <div class="flex gap-4">
                    <a href="#shop"
                        class="bg-white text-primary px-8 py-3 font-semibold rounded shadow hover:-translate-y-1 transition">
                        Shop Now
                    </a>
                    <a href="#categories"
                        class="border border-white px-8 py-3 font-semibold rounded hover:bg-white hover:text-primary transition">
                        Explore
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="categories" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Shop by Category</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Browse categories to find exactly what you need.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <a href="#" class="relative group h-64 rounded-lg overflow-hidden shadow-sm">

                        <img src="{{ asset('assets/upload/category/' . $category->image) }}" alt="{{ $category->name }}"
                            loading="lazy" class="w-full h-full object-cover transition group-hover:scale-110">

                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition"></div>

                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-white text-2xl font-bold">
                                {{ $category->name }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>

    <section id="shop" class="my-16 py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
                    <p class="text-gray-600 mt-2">Best-selling picks for you.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach ($featuredProducts as $product)
                    @php
                        $image = $product->images[0] ?? 'placeholder.jpg';
                    @endphp

                    <div class="group relative">
                        <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-md bg-gray-200 relative mb-4">

                            <img src="{{ asset('uploads/products/gallery/' . $image) }}" alt="{{ $product->name }}"
                                loading="lazy" class="w-full h-full object-cover group-hover:opacity-90 transition">

                            @if ($product->is_new)
                                <div class="absolute top-2 left-2 bg-white px-2 py-1 text-xs font-bold rounded">
                                    NEW
                                </div>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-700">
                                {{ $product->name }}
                            </h3>

                            <p class="mt-1 text-lg font-medium text-gray-900">
                                ৳{{ number_format($product->price) }}
                            </p>

                            <div class="mt-1 flex text-yellow-400 text-xs">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $product->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ================= NEWSLETTER ================= --}}
    <section class="py-16 bg-gray-50 border-t">
        <div class="container mx-auto px-4 text-center max-w-xl">
            <h2 class="text-2xl font-bold mb-4">Join Our Newsletter</h2>
            <p class="text-gray-600 mb-8">Deals, new products, no spam.</p>

            <form class="flex flex-col sm:flex-row gap-3"
                onsubmit="event.preventDefault(); showToast('Subscribed!', 'success');">

                <input type="email" required placeholder="Enter your email"
                    class="flex-1 border rounded-md px-4 py-3 focus:ring-2 focus:ring-accent">

                <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-md hover:bg-accent transition">
                    Subscribe
                </button>
            </form>
        </div>
    </section>

@endsection

{{-- ================= PAGE SCRIPTS ================= --}}
@push('scripts')
    <script>
        let cartCount = 0;
        const cartCountElement = document.getElementById('cart-count');
        const toastContainer = document.getElementById('toast-container');

        function addToCart(name) {
            cartCount++;
            cartCountElement.innerText = cartCount;
            cartCountElement.classList.remove('opacity-0');
            showToast(`${name} added to cart`);
        }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = 'bg-white shadow rounded p-4 mb-3 border-l-4 border-accent';
            toast.innerText = message;

            toastContainer.appendChild(toast);

            setTimeout(() => toast.remove(), 3000);
        }
    </script>
@endpush