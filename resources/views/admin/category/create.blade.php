@extends('layouts.admin-app')

@section('content')
    <div class="p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">New Category</h2>
                <p class="text-sm text-gray-500">Create a new category for your products</p>
            </div>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">
                ← Back to Categories
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 max-w-3xl mx-auto">

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Category Name" required>
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Slug <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="slug" value="{{ old('slug') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="category-slug" required>
                    @error('slug')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category Image <span
                            class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed rounded-xl p-4 text-center">

                        <img id="preview" src="https://via.placeholder.com/300x200?text=No+Image"
                            class="mx-auto mb-3 max-h-40 object-contain rounded">

                        <label
                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg cursor-pointer hover:bg-blue-700">
                            <i class="icon-upload-cloud"></i>
                            Select Image
                            <input type="file" id="imageInput" name="image" class="hidden" accept="image/*">
                        </label>

                        @error('image')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('categories.index') }}"
                        class="px-5 py-2 text-sm bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Save Category
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Image preview
            const input = document.getElementById('imageInput');
            const preview = document.getElementById('preview');

            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                preview.src = URL.createObjectURL(file);
            });

            // Auto-generate slug from name
            const nameInput = document.querySelector('input[name="name"]');
            const slugInput = document.querySelector('input[name="slug"]');

            nameInput.addEventListener('input', () => {
                slugInput.value = nameInput.value.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
            });
        });
    </script>
@endpush