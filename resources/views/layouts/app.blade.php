<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AB Shop</title>

    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind Config & Custom CSS -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1F2937', // Gray 800
                        secondary: '#F3F4F6', // Gray 100
                        accent: '#D97706', // Amber 600
                    }
                }
            }
        }
    </script>

    <style>
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Toast Animation */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        /* Hide scrollbar for horizontal scroll areas */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-white antialiased">

    <!-- Navigation -->
    <header class="fixed w-full top-0 z-40 bg-white/95 backdrop-blur-md shadow-sm transition-all duration-300"
        id="navbar">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center cursor-pointer">
                    <a href="{{ route('home') }}">
                        <span class="text-2xl font-bold tracking-tighter text-primary">AB Shop</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-600 hover:text-accent font-medium transition">Home</a>
                    <a href="{{ route('shop.index') }}"
                        class="text-gray-600 hover:text-accent font-medium transition">Shop</a>
                    <a href="{{ route('contact.index') }}"
                        class="text-gray-600 hover:text-accent font-medium transition">Contact Us</a>
                    <a href="{{ route('about') }}"
                        class="text-gray-600 hover:text-accent font-medium transition">About</a>
                </nav>

                <!-- Icons (Search, User, Cart) -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('user.dashboard') }}"
                        class="text-gray-500 hover:text-primary transition hidden sm:block">
                        <i class="fa-regular fa-user text-lg"></i>
                    </a>

                    <a href="{{ route('cart.index') }}"
                        class="relative text-gray-500 hover:text-primary transition group">
                        <i class="fa-solid fa-bag-shopping text-lg group-hover:scale-110 transition-transform"></i>
                        <span id="cart-count"
                            class="absolute -top-2 -right-2 bg-accent text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full opacity-0 transition-opacity">0</span>
                    </a>

                    <a href="{{ route('wishlist.index') }}"
                        class="relative text-gray-500 hover:text-primary transition group">
                        <i class="fa-solid fa-heart text-lg group-hover:scale-110 transition-transform"></i>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden text-gray-600 focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full left-0 shadow-lg">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-accent rounded-md">Home</a>
                <a href="{{ route('shop.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-accent rounded-md">Shop</a>
                <a href="{{ route('contact.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-accent rounded-md">Contact
                    Us</a>
                <a href="{{ route('about') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-accent rounded-md">About</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="about" class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div>
                    <span class="text-2xl font-bold tracking-tighter text-white">Ab Shop</span>
                    <p class="mt-4 text-sm text-gray-400">
                        Your one-stop shop for quality products that combines style and comfort. Transform your fashion
                        with our curated collections.
                    </p>
                    {{-- <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i
                                class="fa-brands fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i
                                class="fa-brands fa-twitter text-xl"></i></a>
                    </div> --}}
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Shop</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-accent transition">Home</a></li>
                        <li><a href="#" class="hover:text-accent transition">Shop</a></li>
                        <li><a href="#" class="hover:text-accent transition">Contact</a></li>
                        <li><a href="#" class="hover:text-accent transition">About</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-accent transition">Shipping & Returns</a></li>
                        <li><a href="#" class="hover:text-accent transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-accent transition">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Payment Methods</h4>
                    <div class="flex flex-wrap gap-2">
                        <div class="bg-gray-800 p-2 rounded text-xs"><i class="fa-brands fa-cc-visa text-2xl"></i></div>
                        <div class="bg-gray-800 p-2 rounded text-xs"><i class="fa-brands fa-cc-mastercard text-2xl"></i>
                        </div>
                        <div class="bg-gray-800 p-2 rounded text-xs"><i class="fa-brands fa-cc-paypal text-2xl"></i>
                        </div>
                        <div class="bg-gray-800 p-2 rounded text-xs"><i class="fa-brands fa-cc-apple-pay text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p>&copy; 2024 AB Shop. All rights reserved.</p>
                <p>Designed by RAFI UDDIN.</p>
            </div>
        </div>
    </footer>

    @stack("scripts")
</body>

</html>