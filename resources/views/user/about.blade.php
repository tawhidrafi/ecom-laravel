@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[70vh] flex items-center justify-center bg-gray-900 overflow-hidden">
        <!-- Background Image -->
        <img src="https://picsum.photos/seed/aboutHero/1920/1080" alt="Furniture Workshop"
            class="absolute inset-0 w-full h-full object-cover opacity-60">

        <!-- Content -->
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 leading-tight">Designing
                Spaces,<br>Creating Memories.</h1>
            <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto">
                We believe that great design should be accessible to everyone. At Lumina, we craft furniture that
                blends modern aesthetics with everyday functionality.
            </p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Image -->
                <div class="relative">
                    <div class="aspect-w-4 aspect-h-5 rounded-lg overflow-hidden shadow-2xl">
                        <img src="https://picsum.photos/seed/workshop/800/1000" alt="Craftsman working"
                            class="w-full h-full object-cover transform hover:scale-105 transition duration-700">
                    </div>
                    <!-- Decorative Element -->
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-accent rounded-lg -z-10 hidden md:block">
                    </div>
                </div>

                <!-- Text -->
                <div>
                    <h2 class="text-accent font-bold uppercase tracking-wider text-sm mb-4">Our Story</h2>
                    <h3 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-6">Crafted with passion,
                        built for life.</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Lumina started in 2024 with a simple idea: modern furniture shouldn't be complicated or
                        unaffordable. Founded by a team of interior designers and architects, we set out to bridge
                        the gap between high-end gallery pieces and everyday home decor.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        We work directly with independent artisans and sustainable manufacturers to ensure every
                        piece we sell meets our rigorous standards of quality, durability, and ethical production.
                    </p>
                    <a href="shop.html"
                        class="inline-block bg-primary text-white px-8 py-3 rounded font-semibold hover:bg-gray-800 transition shadow-lg">Shop
                        Our Story</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Values / Features -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">What Drives Us</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Our core values guide every decision we make, from
                    sourcing materials to customer service.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100">
                    <div
                        class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-6 text-accent text-2xl">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Quality Materials</h3>
                    <p class="text-gray-600 leading-relaxed">
                        We source premium woods, durable fabrics, and non-toxic finishes to ensure your furniture
                        looks great and lasts for years.
                    </p>
                </div>

                <!-- Value 2 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100">
                    <div
                        class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-6 text-green-600 text-2xl">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sustainability</h3>
                    <p class="text-gray-600 leading-relaxed">
                        We are committed to reducing our carbon footprint by using FSC-certified wood and
                        eco-friendly packaging solutions.
                    </p>
                </div>

                <!-- Value 3 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100">
                    <div
                        class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6 text-blue-600 text-2xl">
                        <i class="fa-solid fa-people-carry-box"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fair Labor</h3>
                    <p class="text-gray-600 leading-relaxed">
                        We believe in fair wages and safe working conditions. We partner with manufacturers who
                        treat their workers with dignity and respect.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Banner -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 divide-gray-700">
                <div>
                    <div class="text-4xl font-bold mb-2">10k+</div>
                    <div class="text-gray-400 text-sm uppercase tracking-wide">Happy Customers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-gray-400 text-sm uppercase tracking-wide">Unique Products</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-gray-400 text-sm uppercase tracking-wide">Expert Designers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">4.9/5</div>
                    <div class="text-gray-400 text-sm uppercase tracking-wide">Average Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- The Team -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Meet The Team</h2>
                <p class="text-gray-600">The creative minds behind Lumina.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Member 1 -->
                <div class="text-center group">
                    <div class="relative w-48 h-48 mx-auto mb-6 overflow-hidden rounded-full">
                        <img src="https://picsum.photos/seed/person1/300/300" alt="CEO"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Sarah Jenkins</h3>
                    <p class="text-accent font-medium text-sm mb-3">Founder & CEO</p>
                    <p class="text-gray-500 text-sm px-4">Visionary leader with a passion for minimalist aesthetics.
                    </p>
                </div>

                <!-- Member 2 -->
                <div class="text-center group">
                    <div class="relative w-48 h-48 mx-auto mb-6 overflow-hidden rounded-full">
                        <img src="https://picsum.photos/seed/person2/300/300" alt="Lead Designer"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">David Ross</h3>
                    <p class="text-accent font-medium text-sm mb-3">Head of Design</p>
                    <p class="text-gray-500 text-sm px-4">Award-winning architect focused on functionality.</p>
                </div>

                <!-- Member 3 -->
                <div class="text-center group">
                    <div class="relative w-48 h-48 mx-auto mb-6 overflow-hidden rounded-full">
                        <img src="https://picsum.photos/seed/person3/300/300" alt="Operations"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Elena Rodriguez</h3>
                    <p class="text-accent font-medium text-sm mb-3">Operations Manager</p>
                    <p class="text-gray-500 text-sm px-4">Ensures every detail of your experience is perfect.</p>
                </div>

                <!-- Member 4 -->
                <div class="text-center group">
                    <div class="relative w-48 h-48 mx-auto mb-6 overflow-hidden rounded-full">
                        <img src="https://picsum.photos/seed/person4/300/300" alt="Creative"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Michael Chen</h3>
                    <p class="text-accent font-medium text-sm mb-3">Creative Director</p>
                    <p class="text-gray-500 text-sm px-4">Trendsetter bringing fresh ideas to the table.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gray-900 text-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">Be part of our journey</h2>
            <p class="text-gray-400 mb-8 max-w-xl mx-auto">Subscribe to our newsletter for design tips, new
                arrivals, and exclusive offers.</p>
            <form onsubmit="event.preventDefault(); alert('Thanks for subscribing!');" class="max-w-md mx-auto flex gap-3">
                <input type="email" placeholder="Enter your email"
                    class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-accent">
                <button type="submit"
                    class="bg-accent text-white px-6 py-3 rounded-lg font-bold hover:bg-orange-700 transition">Subscribe</button>
            </form>
        </div>
    </section>
@endsection