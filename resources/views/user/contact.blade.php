@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

            <div class="lg:col-span-2">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a message</h2>

                    <form class="space-y-6" action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" id="name" required name="name"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent py-3 px-4 border transition outline-none"
                                    placeholder="John Doe">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" id="phone" required name="phone"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent py-3 px-4 border transition outline-none"
                                    placeholder="+880 1234 567890">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <input type="email" id="email" required name="email"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent py-3 px-4 pl-12 border transition outline-none"
                                    placeholder="john@example.com">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                            </div>
                        </div>

                        {{-- <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <select id="subject"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent py-3 px-4 border bg-white transition outline-none">
                                <option>General Inquiry</option>
                                <option>Product Question</option>
                                <option>Order Status</option>
                                <option>Return / Refund</option>
                                <option>Partnership</option>
                            </select>
                        </div> --}}

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" rows="5" required name="message"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent py-3 px-4 border transition outline-none"
                                placeholder="How can we help you today?"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white py-4 rounded-lg font-bold text-lg hover:bg-gray-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Info & Map -->
            <div class="space-y-8">

                <!-- Contact Info Cards -->
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-accent flex-shrink-0">
                            <i class="fa-solid fa-location-dot text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Visit Us</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                BGC Bidyanagar<br>
                                Chandanaish, Chattogram<br>
                                Bangladesh
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-accent flex-shrink-0">
                            <i class="fa-solid fa-phone text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Call Us</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Saturday - Thursday from 10am to 6pm.<br>
                            <p class="font-medium text-gray-900 hover:text-accent transition">+880 1234-567891</p>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-accent flex-shrink-0">
                            <i class="fa-solid fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Email Us</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                We usually respond within 24 hours.<br>
                                <a href="#"
                                    class="font-medium text-gray-900 hover:text-accent transition">support@abshop.com</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-gray-900 p-6 rounded-xl text-center text-white">
                    <h3 class="font-bold mb-4">Follow Our Socials</h3>
                    <div class="flex justify-center space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i
                                class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i
                                class="fa-brands fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection