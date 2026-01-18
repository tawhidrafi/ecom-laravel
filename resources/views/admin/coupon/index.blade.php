@extends('layouts.admin-app')

@section('content')
    <div class="p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Coupons</h2>
                <p class="text-sm text-gray-500">Manage all your coupons</p>
            </div>
            <a href="{{ route('coupons.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                + Add New
            </a>
        </div>

        <!-- Search -->
        <div class="mb-4">
            <form class="flex gap-2 max-w-md">
                <input type="text" name="name" placeholder="Search here..."
                    class="flex-grow px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <button type="submit" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    🔍
                </button>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Code</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Min Amount</th>
                        <th class="px-4 py-2">Expiry Date</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($coupons as $coupon)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $coupon->id }}</td>
                            <td class="px-4 py-2">{{ $coupon->code }}</td>
                            <td class="px-4 py-2">{{ ucfirst($coupon->type) }}</td>
                            <td class="px-4 py-2">${{ $coupon->amount }}</td>
                            <td class="px-4 py-2">${{ $coupon->min_purchase }}</td>
                            <td class="px-4 py-2">{{ $coupon->expiry_date }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('coupons.edit', $coupon) }}"
                                    class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a>
                                <button type="button"
                                    class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 delete-btn"
                                    data-id="{{ $coupon->id }}">
                                    Delete
                                </button>
                                <form id="delete-form-{{ $coupon->id }}" action="{{ route('coupons.destroy', $coupon) }}"
                                    method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $coupons->links('pagination::tailwind') }}
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.getAttribute('data-id');
                    const form = document.getElementById(`delete-form-${id}`);

                    if (confirm("Are you sure you want to delete this coupon?")) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush