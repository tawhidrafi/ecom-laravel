@extends('layouts.admin-app')

@section('content')

    <div class="space-y-6">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-semibold">Brands</h1>

            <nav class="text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">
                    Dashboard
                </a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">Brands</span>
            </nav>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow p-4 flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between">

            <form method="GET" class="flex items-center gap-2 w-full sm:max-w-sm">
                <input type="text" name="name" placeholder="Search brands..."
                    class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-500" />
                <button class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200">
                    Search
                </button>
            </form>

            <a href="{{ route('brands.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                + Add Brand
            </a>
        </div>

        <!-- Flash message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Brand</th>
                            <th class="px-4 py-3 text-left">Slug</th>
                            <th class="px-4 py-3 text-center">Products</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($brands as $brand)
                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3">{{ $brand->id }}</td>

                                <td class="px-4 py-3 flex items-center gap-3">
                                    <img src="{{ asset('assets/upload/brand/' . $brand->image) }}" alt="{{ $brand->name }}"
                                        class="w-10 h-10 rounded object-cover">
                                    <span class="font-medium">{{ $brand->name }}</span>
                                </td>

                                <td class="px-4 py-3 text-gray-500">
                                    {{ $brand->slug }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                        {{ $brand->products_count ?? 0 }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-3">

                                        <a href="{{ route('brands.edit', $brand) }}" class="text-blue-600 hover:underline">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('brands.destroy', $brand) }}" data-delete-form>
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="text-red-600 hover:underline" data-delete-btn>
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t">
                {{ $brands->links() }}
            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('click', function (e) {

            const deleteBtn = e.target.closest('[data-delete-btn]');
            if (!deleteBtn) return;

            e.preventDefault();

            const form = deleteBtn.closest('[data-delete-form]');
            if (!form) return;

            const confirmed = confirm('Are you sure you want to delete this brand?');

            if (confirmed) {
                form.submit();
            }
        });

    </script>
@endpush