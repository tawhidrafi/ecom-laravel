@extends('layouts.admin-app')

@section('content')
    <div class="p-6 max-w-full mx-auto space-y-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">All Products</h2>
            </div>
            <a href="{{ route('products.create') }}"
                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 flex items-center gap-2">
                <i class="icon-plus"></i> Add New
            </a>
        </div>

        <!-- Search -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-1 gap-2">
                <input type="text" name="name" placeholder="Search here..."
                    class="flex-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:border-gray-300"
                    value="{{ request('name') }}">
                <button type="submit" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800">
                    Search
                </button>
            </form>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Products Table -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Sale Price</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">SKU</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Brand</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Featured</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Stock</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-700">{{ $product->id }}</td>
                            <td class="px-4 py-2 flex items-center gap-2">
                                <img src="{{ $product->image ? asset('assets/upload/product/' . $product->image) : asset('assets/images/placeholder.png') }}"
                                    alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-700">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700">${{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-2 text-center text-gray-700">${{ number_format($product->sale_price, 2) }}</td>
                            <td class="px-4 py-2 text-center text-gray-700">{{ $product->SKU }}</td>
                            <td class="px-4 py-2 text-center text-gray-700">{{ $product->category->name ?? '—' }}</td>
                            <td class="px-4 py-2 text-center text-gray-700">{{ $product->brand->name ?? '—' }}</td>
                            <td class="px-4 py-2 text-center">
                                <span class="{{ $product->featured ? 'text-green-600' : 'text-gray-400' }}">
                                    {{ $product->featured ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="{{ $product->in_stock ? 'text-green-600' : 'text-gray-400' }}">
                                    {{ $product->in_stock ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700">{{ $product->stock }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="#" target="_blank" class="text-blue-500 hover:text-blue-700">
                                        <i class="icon-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <i class="icon-edit-3"></i>
                                    </a>
                                    <button type="button" data-id="{{ $product->id }}"
                                        class="text-red-500 hover:text-red-700 delete-button">
                                        <i class="icon-trash-2"></i>
                                    </button>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product) }}"
                                        method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    if (confirm("Are you sure you want to delete this product?")) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            });
        });
    </script>
@endpush