@extends('layouts.admin-app')

@section('content')
    <div class="p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Categories</h2>
                <p class="text-sm text-gray-500">Manage product categories</p>
            </div>

            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                <i class="icon-plus"></i>
                Add Category
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-sm">

            <!-- Search -->
            <div class="p-4 border-b">
                <form class="flex gap-3 max-w-md">
                    <input type="text" name="name" placeholder="Search categories..."
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <button class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                        <i class="icon-search"></i>
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Category</th>
                            <th class="px-4 py-3 text-left">Slug</th>
                            <th class="px-4 py-3 text-center">Products</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3">{{ $category->id }}</td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('assets/upload/category/thumb/' . $category->image) }}"
                                            class="w-10 h-10 rounded-lg object-cover" alt="{{ $category->name }}">
                                        <span class="font-medium text-gray-800">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $category->slug }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                                        1
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-3">

                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="icon-edit-3"></i>
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            class="delete-form inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:text-red-800 delete-btn">
                                                <i class="icon-trash-2"></i>
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
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this category?')) {
                    this.closest('form').submit();
                }
            });
        });
    </script>
@endpush