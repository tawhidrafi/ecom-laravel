@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">My Orders</h1>
                <p class="text-gray-500 mt-1">Track and manage your recent purchases.</p>
            </div>

            <div class="flex flex-wrap gap-2 bg-white p-1 rounded-lg border border-gray-200 w-max">
                <button onclick="filterOrders('all', this)"
                    class="filter-btn px-4 py-2 text-sm font-medium rounded-md bg-gray-100 text-gray-900 transition">All</button>
                <button onclick="filterOrders('pending', this)"
                    class="filter-btn px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 transition">Pending</button>
                <button onclick="filterOrders('confirmed', this)"
                    class="filter-btn px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 transition">Confirmed</button>
                <button onclick="filterOrders('shipped', this)"
                    class="filter-btn px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 transition">Shipped</button>
                <button onclick="filterOrders('delivered', this)"
                    class="filter-btn px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 transition">Delivered</button>
                <button onclick="filterOrders('cancelled', this)"
                    class="filter-btn px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 transition">Cancelled</button>
            </div>
        </div>

        <div class="space-y-4" id="orders-container">

            @if ($orders->isEmpty())
                <div id="empty-state" class="hidden flex-col items-center justify-center py-20 text-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">No orders found</h2>
                    <p class="text-gray-500 mb-8 max-w-md">There are no orders matching your selected filter status.</p>
                    <button onclick="filterOrders('all', document.querySelector('.filter-btn'))"
                        class="bg-primary text-white px-8 py-3 rounded font-bold hover:bg-gray-800 transition shadow-lg">Show
                        All Orders</button>
                </div>
            @else
                @foreach ($orders as $order)
                    <div class="order-card bg-white rounded-lg shadow-sm border border-gray-100 p-6 md:p-8"
                        data-status="{{ strtolower($order->status) }}">
                        <div class="flex flex-col md:flex-row gap-6 md:items-center justify-between">

                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 hover:text-accent cursor-pointer transition">
                                        Order #{{ $order->id }}</h3>
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ ucfirst($order->status) }}</span>
                                </div>
                                <p class="text-gray-500 text-sm">Placed on {{ $order->created_at }}</p>
                            </div>

                            <div class="flex items-center gap-6 md:gap-8">
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Total</p>
                                    <p class="text-lg font-bold text-gray-900">${{ $order->total }}</p>
                                </div>
                                <div class="flex flex-col md:flex-row gap-3">
                                    <a href="{{ route('user.orders.show', $order) }}"
                                        class="text-sm font-medium text-primary hover:text-accent border border-gray-200 px-4 py-2 rounded hover:border-accent transition text-center">View
                                        Details</a>
                                    <button class="text-sm font-medium text-gray-600 hover:text-primary transition text-center">Buy
                                        Again</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // --- Filter Orders ---
        function filterOrders(status, btnElement) {
            const cards = document.querySelectorAll('.order-card');
            const emptyState = document.getElementById('empty-state');
            let visibleCount = 0;

            // Update Button Styles
            if (btnElement) {
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.className = "filter-btn px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 transition";
                });
                btnElement.className = "filter-btn px-4 py-2 text-sm font-medium rounded-md bg-gray-100 text-gray-900 transition";
            }

            // Filter Logic
            cards.forEach(card => {
                if (status === 'all' || card.getAttribute('data-status') === status) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Toggle Empty State
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
            } else {
                emptyState.classList.add('hidden');
                emptyState.classList.remove('flex');
            }
        }
    </script>
@endpush