@extends('layouts.app')

@section('content')
    <!-- Profile Header -->
    <div class="bg-white shadow-sm mb-8">
        <div class="h-48 md:h-64 bg-gray-200 relative overflow-hidden">
            <img src="https://picsum.photos/seed/coverprofile/1200/400" alt="Cover" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative px-4">
            <!-- Avatar & Basic Info -->
            <div class="flex flex-col md:flex-row items-start md:items-end -mt-12 md:-mt-16 pb-6 border-b border-gray-100">
                <div class="relative">
                    <img src="https://picsum.photos/seed/user1/200/200" alt="Avatar"
                        class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-white shadow-md object-cover">
                    <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-2 border-white rounded-full">
                    </div>
                </div>

                <div class="mt-4 md:mt-0 md:ml-6 flex-1">
                    <h1 class="text-2xl font-bold text-gray-900">John Doe</h1>
                    <p class="text-gray-500 text-sm">@johndoe</p>
                    <p class="text-gray-600 mt-2 max-w-2xl">
                        Interior design enthusiast and minimalism lover. I buy furniture for the vibes, not just the
                        function. ☕✨
                    </p>
                </div>

                <div class="mt-6 md:mt-0 flex gap-4">
                    <!-- Stats -->
                    <div class="hidden md:flex flex-col text-center px-4 border-r border-gray-100">
                        <span class="text-lg font-bold text-gray-900">142</span>
                        <span class="text-xs text-gray-500 uppercase tracking-wide">Followers</span>
                    </div>
                    <div class="hidden md:flex flex-col text-center px-4 border-r border-gray-100">
                        <span class="text-lg font-bold text-gray-900">28</span>
                        <span class="text-xs text-gray-500 uppercase tracking-wide">Reviews</span>
                    </div>
                    <div class="hidden md:flex flex-col text-center px-4">
                        <span class="text-lg font-bold text-gray-900">5</span>
                        <span class="text-xs text-gray-500 uppercase tracking-wide">Lists</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <button onclick="toggleFollow(this)"
                            class="follow-btn px-6 py-2 rounded-lg border-2 border-gray-300 text-gray-700 font-bold text-sm hover:bg-gray-50 transition">
                            Follow
                        </button>
                        <button class="p-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                            <i class="fa-solid fa-share-nodes"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Stats (Visible only on mobile) -->
            <div class="flex justify-around py-4 md:hidden border-b border-gray-100">
                <div class="text-center">
                    <span class="block font-bold text-gray-900">142</span>
                    <span class="text-xs text-gray-500">Followers</span>
                </div>
                <div class="text-center">
                    <span class="block font-bold text-gray-900">28</span>
                    <span class="text-xs text-gray-500">Reviews</span>
                </div>
                <div class="text-center">
                    <span class="block font-bold text-gray-900">5</span>
                    <span class="text-xs text-gray-500">Lists</span>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="flex space-x-8">
                <button onclick="switchTab('reviews', this)"
                    class="tab-btn border-b-2 border-accent text-accent py-4 text-sm font-bold transition">Reviews</button>
                <button onclick="switchTab('wishlist', this)"
                    class="tab-btn border-b-2 border-transparent text-gray-500 hover:text-gray-700 py-4 text-sm font-bold transition">Wishlist</button>
                <button onclick="switchTab('collections', this)"
                    class="tab-btn border-b-2 border-transparent text-gray-500 hover:text-gray-700 py-4 text-sm font-bold transition">Collections</button>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Content: Reviews -->
        <div id="reviews" class="tab-content animate-fade-in">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Recent Reviews</h2>
            <div class="space-y-6">

                <!-- Review 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden">
                                <img src="https://picsum.photos/seed/chair2/100/100" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Velvet Armchair</h3>
                                <div class="flex text-yellow-400 text-xs mt-1">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">2 days ago</span>
                    </div>
                    <p class="text-gray-600 mt-4 text-sm leading-relaxed">
                        Absolutely in love with this chair! The velvet texture is incredibly soft, and the color is
                        exactly as shown in the pictures. It fits perfectly in my reading nook. Assembly was a
                        breeze too.
                    </p>
                    <div class="mt-4 flex gap-3">
                        <img src="https://picsum.photos/seed/review1/100/100"
                            class="w-16 h-16 rounded-md object-cover border border-gray-200">
                        <img src="https://picsum.photos/seed/review2/100/100"
                            class="w-16 h-16 rounded-md object-cover border border-gray-200">
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden">
                                <img src="https://picsum.photos/seed/lamp2/100/100" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Industrial Floor Lamp</h3>
                                <div class="flex text-yellow-400 text-xs mt-1">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star-half-stroke"></i>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">2 weeks ago</span>
                    </div>
                    <p class="text-gray-600 mt-4 text-sm leading-relaxed">
                        Great lamp, gives off a really warm light. My only gripe is the cord is a bit shorter than
                        expected, but an extension cord solved that. Solid build quality.
                    </p>
                </div>

            </div>
        </div>

        <!-- Content: Wishlist -->
        <div id="wishlist" class="tab-content hidden animate-fade-in">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Wishlist <span class="text-gray-400 font-normal text-sm ml-2">3
                    items</span></h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Item -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 group">
                    <div class="aspect-square bg-gray-100 rounded-md overflow-hidden mb-3 relative">
                        <img src="https://picsum.photos/seed/table2/300/300"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <button
                            class="absolute top-2 right-2 bg-white/80 p-1.5 rounded-full text-gray-400 hover:text-red-500 transition"><i
                                class="fa-solid fa-heart text-xs"></i></button>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900 truncate">Oak Coffee Table</h3>
                    <p class="text-sm font-bold text-gray-900">$145.00</p>
                </div>
                <!-- Item -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 group">
                    <div class="aspect-square bg-gray-100 rounded-md overflow-hidden mb-3 relative">
                        <img src="https://picsum.photos/seed/plant/300/300"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <button
                            class="absolute top-2 right-2 bg-white/80 p-1.5 rounded-full text-gray-400 hover:text-red-500 transition"><i
                                class="fa-solid fa-heart text-xs"></i></button>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900 truncate">Large Ceramic Pot</h3>
                    <p class="text-sm font-bold text-gray-900">$35.00</p>
                </div>
                <!-- Item -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 group">
                    <div class="aspect-square bg-gray-100 rounded-md overflow-hidden mb-3 relative">
                        <img src="https://picsum.photos/seed/rug/300/300"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <button
                            class="absolute top-2 right-2 bg-white/80 p-1.5 rounded-full text-gray-400 hover:text-red-500 transition"><i
                                class="fa-solid fa-heart text-xs"></i></button>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900 truncate">Modern Area Rug</h3>
                    <p class="text-sm font-bold text-gray-900">$89.00</p>
                </div>
            </div>
        </div>

        <!-- Content: Collections -->
        <div id="collections" class="tab-content hidden animate-fade-in">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Curated Collections</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Collection Card -->
                <div class="relative h-48 rounded-lg overflow-hidden cursor-pointer group">
                    <img src="https://picsum.photos/seed/interior99/600/300"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div
                        class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition flex flex-col justify-end p-6">
                        <h3 class="text-white text-xl font-bold">Living Room Inspo</h3>
                        <p class="text-gray-200 text-sm">12 Items</p>
                    </div>
                </div>
                <!-- Collection Card -->
                <div class="relative h-48 rounded-lg overflow-hidden cursor-pointer group">
                    <img src="https://picsum.photos/seed/kitchen/600/300"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div
                        class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition flex flex-col justify-end p-6">
                        <h3 class="text-white text-xl font-bold">Kitchen Essentials</h3>
                        <p class="text-gray-200 text-sm">5 Items</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // --- Toggle Follow Button ---
        function toggleFollow(btn) {
            if (btn.innerText === "Follow") {
                btn.innerText = "Following";
                btn.classList.remove('border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
                btn.classList.add('bg-accent', 'text-white', 'border-accent');
            } else {
                btn.innerText = "Follow";
                btn.classList.remove('bg-accent', 'text-white', 'border-accent');
                btn.classList.add('border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
            }
        }

        // --- Tab Switching ---
        function switchTab(tabId, btn) {
            // Hide all
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('border-accent', 'text-accent');
                el.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected
            document.getElementById(tabId).classList.remove('hidden');
            btn.classList.remove('border-transparent', 'text-gray-500');
            btn.classList.add('border-accent', 'text-accent');
        }
    </script>
@endpush