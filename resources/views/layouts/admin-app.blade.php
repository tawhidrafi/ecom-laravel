<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50">

            <!-- Header / Brand -->
            <div class="h-16 flex items-center justify-between px-4">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-gray-800">
                    AB SHOP
                </a>

                <!-- Close button (mobile only) -->
                <button id="sidebarClose" class="lg:hidden p-2 rounded-md hover:bg-gray-200">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="mt-4">
                <ul class="space-y-1">
                    <li> <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                            Dashboard </a> </li>
                    <li> <button
                            class="w-full flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium submenu-toggle">
                            Brands <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg> </button>
                        <ul class="ml-4 mt-1 space-y-1 hidden">
                            <li><a href="{{ route('brands.create') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Add Brand</a>
                            </li>
                            <li><a href="{{ route('brands.index') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Brands</a></li>
                        </ul>
                    </li>
                    <li> <button
                            class="w-full flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium submenu-toggle">
                            Categories <svg class="w-4 h-4 transition-transform transform" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg> </button>
                        <ul class="ml-4 mt-1 space-y-1 hidden">
                            <li><a href="{{ route('categories.create') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Add Category</a>
                            </li>
                            <li><a href="{{ route('categories.index') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li> <button
                            class="w-full flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium submenu-toggle">
                            Products <svg class="w-4 h-4 transition-transform transform" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg> </button>
                        <ul class="ml-4 mt-1 space-y-1 hidden">
                            <li><a href="{{ route('products.create') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Add Product</a>
                            </li>
                            <li><a href="{{ route('products.index') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Products</a></li>
                        </ul>
                    </li>
                    <li> <a href="{{ route('admin.orders.index') }}"
                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                            Orders </a> </li>
                    <li> <a href="#"
                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                            Settings </a> </li>
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col lg:ml-64">

            <!-- Header -->
            <header class="h-16 bg-white flex items-center justify-between px-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <!-- Mobile sidebar toggle -->
                    <button id="sidebarToggle" class="lg:hidden p-2 rounded-md hover:bg-gray-200">
                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <span class="font-medium text-gray-700">{{ Auth::guard('admin')->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button class="text-red-600 font-medium hover:underline">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Main content area -->
            <main class="flex-1 overflow-auto p-6 bg-gray-100">
                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.getElementById("sidebar");
            const toggleBtn = document.getElementById("sidebarToggle");
            const closeBtn = document.getElementById("sidebarClose");

            // Open sidebar (mobile)
            toggleBtn.addEventListener("click", () => {
                sidebar.classList.remove("-translate-x-full");
            });

            // Close sidebar (mobile)
            closeBtn.addEventListener("click", () => {
                sidebar.classList.add("-translate-x-full");
            });

            // Submenu toggle
            document.querySelectorAll(".submenu-toggle").forEach(button => {
                button.addEventListener("click", () => {
                    const submenu = button.nextElementSibling;
                    submenu.classList.toggle("hidden");
                    button.querySelector("svg").classList.toggle("rotate-180");
                });
            });
        });
    </script>

</body>

</html>