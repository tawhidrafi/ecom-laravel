@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-50 border-b border-gray-100 py-4">
        <div class="container mx-auto px-4">
            <p class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('shop.index') }}" class="hover:text-primary">Shop</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">{{ $product->name }}</span>
            </p>
        </div>
    </div>

    <!-- Product Details Section -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Left: Gallery -->
            <div class="space-y-4">
                <div class="aspect-square aspect-square w-full overflow-hidden rounded-lg bg-gray-100 relative group">
                    <img id="main-image" src="{{ asset('assets/upload/product') . '/' . $product->image }}"
                        alt="Product Main"
                        class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-105 cursor-zoom-in">
                    <div
                        class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition duration-300 pointer-events-none">
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <button type="button"
                        onclick="changeImage(this, '{{ asset('assets/upload/product') . '/' . $product->image }}')"
                        class="thumb aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg border-2 border-transparent hover:border-gray-300 transition">

                        <img src="{{ asset('assets/upload/product') . '/' . $product->image }}" alt="Product thumbnail"
                            loading="lazy" class="h-full w-full object-cover object-center">
                    </button>

                    @if (!empty($product->images))
                        @foreach ($product->images as $item)

                            @php
                                $imageUrl = asset('uploads/products/gallery/' . $item);
                            @endphp

                            <button type="button" onclick="changeImage(this, '{{ $imageUrl }}')"
                                class="thumb aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg border-2 border-transparent hover:border-gray-300 transition">

                                <img src="{{ $imageUrl }}" alt="Product thumbnail" loading="lazy"
                                    class="h-full w-full object-cover object-center">
                            </button>
                        @endforeach
                    @endif

                </div>
            </div>

            <!-- Right: Information -->
            <div class="flex flex-col">
                <!-- Header -->
                <div class="mb-6">
                    <span class="text-accent font-semibold text-sm tracking-wide uppercase mb-2 block">
                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    <div class="flex items-center space-x-4">
                        <div class="flex text-yellow-400 text-sm">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <a href="#tab-content-reviews" class="text-sm text-gray-500 hover:text-primary underline">Read 24
                            Reviews</a>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mt-4">
                        @if($product->sale_price)
                            <s> ${{ $product->price }} </s> ${{ $product->sale_price }}
                        @else
                            ${{ $product->price }}
                        @endif
                    </p>
                </div>

                <!-- Short Description -->
                <p class="text-gray-600 leading-relaxed mb-6">
                    {{ $product->short_description }}
                </p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8">

                    @auth
                        @if($cart && $cart->hasProduct($product->id))
                            <a href="{{ route('cart.index') }}"
                                class="flex-1 bg-primary text-white py-4 px-6 rounded-md font-bold hover:bg-gray-800 transition shadow-lg flex items-center justify-center gap-2">
                                View Cart
                            </a>
                        @else
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">

                                <button type="submit"
                                    class="flex-1 bg-primary text-white py-4 px-6 rounded-md font-bold hover:bg-gray-800 transition shadow-lg flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="flex-1 bg-primary text-white py-4 px-6 rounded-md font-bold hover:bg-gray-800 transition shadow-lg flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-plus"></i> Add to Cart
                        </a>
                    @endauth

                    @auth
                        @if($wishList && $wishList->hasProduct($product->id))
                            <a href="{{ route('wishlist.index') }}"
                                class="sm:w-1/3 border border-gray-300 text-gray-700 py-4 px-6 rounded-md font-bold hover:bg-gray-50 transition flex items-center justify-center gap-2">
                                View Wishlist
                            </a>
                        @else
                            <form method="POST" action="{{ route('wishlist.add') }}">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <button type="submit"
                                    class="sm:w-1/3 border border-gray-300 text-gray-700 py-4 px-6 rounded-md font-bold hover:bg-gray-50 transition flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-heart"></i> Add to Wishlist
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="sm:w-1/3 border border-gray-300 text-gray-700 py-4 px-6 rounded-md font-bold hover:bg-gray-50 transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-heart"></i> Add to Wishlist
                        </a>
                    @endauth
                </div>

                <!-- Meta Info -->
                <div class="border-t border-gray-100 pt-6 text-sm text-gray-600 space-y-2">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-truck-fast text-accent w-5"></i> Free shipping on orders over $150
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-rotate-left text-accent w-5"></i> 30-day return policy
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-shield-halved text-accent w-5"></i> 2-year warranty included
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tabs (Description / Reviews) -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="border-b border-gray-200 mb-8">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="switchTab('description')" id="tab-btn-description"
                    class="tab-btn border-accent text-accent whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Description</button>
                <button onclick="switchTab('reviews')" id="tab-btn-reviews"
                    class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Reviews
                    (24)</button>
                <button onclick="switchTab('shipping')" id="tab-btn-shipping"
                    class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Shipping
                    & Returns</button>
            </nav>
        </div>

        <!-- Tab Content: Description -->
        <div id="tab-content-description" class="tab-content animate-fade-in">
            <div class="prose max-w-none text-gray-600">
                {{ $product->description }}
            </div>
        </div>

        <!-- Tab Content: Reviews -->
        <div id="tab-content-reviews" class="tab-content hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 p-6 rounded-lg text-center">
                        <div class="text-5xl font-bold text-gray-900 mb-2">4.8</div>
                        <div class="flex justify-center text-yellow-400 text-sm mb-2">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p class="text-gray-500 text-sm">Based on 24 reviews</p>
                    </div>
                </div>

                <!-- Review List -->
                <div class="lg:col-span-2 space-y-6" id="review-list">
                    <!-- Review 1 -->
                    <div class="border-b border-gray-100 pb-6">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <img src="https://picsum.photos/seed/u1/40/40" alt="Avatar" class="w-10 h-10 rounded-full">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Alice Johnson</h4>
                                    <p class="text-xs text-gray-500">2 days ago</p>
                                </div>
                            </div>
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm">Absolutely love this chair! It's even more comfortable than
                            it looks in the photos. The gray color matches my living room perfectly.</p>
                    </div>

                    <!-- Review 2 -->
                    <div class="border-b border-gray-100 pb-6">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <img src="https://picsum.photos/seed/u2/40/40" alt="Avatar" class="w-10 h-10 rounded-full">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Mark Davey</h4>
                                    <p class="text-xs text-gray-500">1 week ago</p>
                                </div>
                            </div>
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-regular fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm">Great quality for the price. Assembly was straightforward.
                            Only giving 4 stars because delivery took a day longer than expected.</p>
                    </div>
                </div>
            </div>

            <!-- Review Form -->
            <div class="mt-10 max-w-2xl">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Write a Review</h3>
                <form onsubmit="submitReview(event)" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" placeholder="Your Name" required
                            class="w-full border border-gray-300 rounded p-3 focus:ring-accent focus:border-accent outline-none">
                        <input type="email" placeholder="Your Email" required
                            class="w-full border border-gray-300 rounded p-3 focus:ring-accent focus:border-accent outline-none">
                    </div>
                    <textarea rows="4" placeholder="Your Review" required
                        class="w-full border border-gray-300 rounded p-3 focus:ring-accent focus:border-accent outline-none"></textarea>
                    <button type="submit"
                        class="bg-gray-900 text-white px-6 py-3 rounded font-bold hover:bg-accent transition">Submit
                        Review</button>
                </form>
            </div>
        </div>

        <!-- Tab Content: Shipping -->
        <div id="tab-content-shipping" class="tab-content hidden text-gray-600">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Shipping Policy</h3>
            <p class="mb-4">We offer free standard shipping on all orders over $150. Orders are processed within 1-2
                business days. Standard delivery takes 5-7 business days.</p>

            <h3 class="text-xl font-bold text-gray-900 mb-4 mt-6">Return Policy</h3>
            <p class="mb-4">If you are not completely satisfied with your purchase, you may return it within 30 days
                of receipt for a full refund or exchange. The item must be in its original condition and packaging.
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // --- Image Gallery ---
        function changeImage(thumb, src) {
            // Update main image
            const mainImg = document.getElementById('main-image');
            mainImg.style.opacity = '0'; // simple fade effect
            setTimeout(() => {
                mainImg.src = src;
                mainImg.style.opacity = '1';
            }, 200);

            // Update active state of thumbnails
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        }

        function switchTab(tabName) {
            // Hide all contents
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            // Remove active styles from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-accent', 'text-accent');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            document.getElementById(`tab-content-${tabName}`).classList.remove('hidden');
            // Add active style to selected button
            const activeBtn = document.getElementById(`tab-btn-${tabName}`);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-accent', 'text-accent');
        }
    </script>
@endpush