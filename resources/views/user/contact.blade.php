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
                                    placeholder="+1 (555) 123-4567">
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
                                123 Design Avenue<br>
                                San Francisco, CA 94102<br>
                                United States
                            </p>
                            <a href="#" class="text-sm text-accent font-medium mt-2 inline-block hover:underline">Get
                                Directions</a>
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
                                Mon-Fri from 8am to 5pm.<br>
                                <a href="tel:+15550000000" class="font-medium text-gray-900 hover:text-accent transition">+1
                                    (555)
                                    000-0000</a>
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
                                <a href="mailto:hello@lumina.com"
                                    class="font-medium text-gray-900 hover:text-accent transition">hello@lumina.com</a>
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

                <!-- Map Placeholder -->
                <div
                    class="h-64 w-full bg-gray-200 rounded-xl overflow-hidden relative group cursor-pointer border border-gray-300">
                    <!-- Using a static map image for demo purposes to avoid API keys -->
                    <img src="https://picsum.photos/seed/map/600/400?grayscale" alt="Map Location"
                        class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition">
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <div class="bg-white p-3 rounded-full shadow-lg mb-2">
                            <i class="fa-solid fa-map-location-dot text-accent text-2xl"></i>
                        </div>
                        <span class="bg-white px-3 py-1 rounded-full text-xs font-bold shadow">View on Google
                            Maps</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function submitForm(event) {
            event.preventDefault();

            // Simulate form submission
            const btn = event.target.querySelector('button[type="submit"]');
            const originalText = btn.innerText;

            btn.innerText = "Sending...";
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            setTimeout(() => {
                // Reset Form
                event.target.reset();

                // Reset Button
                btn.innerText = originalText;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');

                // Show Success Toast
                showToast("Message sent successfully! We'll get back to you soon.");
            }, 1500);
        }

        function showToast(message) {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');

            toast.className = `toast flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 border-l-4 border-green-500`;
            toast.innerHTML = `
                                                            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                                                                <i class="fa-solid fa-check"></i>
                                                            </div>
                                                            <div class="ml-3 text-sm font-normal text-gray-800">${message}</div>
                                                        `;
            toastContainer.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('hiding');
                toast.addEventListener('animationend', () => toast.remove());
            }, 3000);
        }
    </script>
@endpush