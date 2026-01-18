@extends('layouts.admin-app')

@section('content')

    <div class="space-y-6 max-w-3xl">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-semibold">New Brand</h1>

            <nav class="text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">
                    Dashboard
                </a>
                <span class="mx-2">/</span>
                <a href="{{ route('brands.index') }}" class="hover:text-gray-700">
                    Brands
                </a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">New</span>
            </nav>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6">

            <form method="POST" action="{{ route('brands.store') }}" enctype="multipart/form-data" class="space-y-6">

                @csrf

                <!-- Brand Name -->
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Brand Name <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                        data-slug-source>

                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Brand Slug -->
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Brand Slug <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="slug" value="{{ old('slug') }}" required
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                        data-slug-target>

                    @error('slug')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Brand Image <span class="text-red-500">*</span>
                    </label>

                    <div class="flex items-center gap-4">
                        <div id="imagePreview" class="hidden w-24 h-24 border rounded-md overflow-hidden">
                            <img class="w-full h-full object-cover" />
                        </div>

                        <label
                            class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200">
                            <span>Upload Image</span>
                            <input type="file" name="image" accept="image/*" class="hidden" data-image-input>
                        </label>
                    </div>

                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('brands.index') }}" class="px-4 py-2 border rounded-md hover:bg-gray-100">
                        Cancel
                    </a>

                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Save Brand
                    </button>
                </div>

            </form>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Slug generation
            const nameInput = document.querySelector('[data-slug-source]');
            const slugInput = document.querySelector('[data-slug-target]');

            if (nameInput && slugInput) {
                nameInput.addEventListener('input', () => {
                    slugInput.value = slugify(nameInput.value);
                });
            }

            // Image preview
            const imageInput = document.querySelector('[data-image-input]');
            const previewWrapper = document.getElementById('imagePreview');
            const previewImage = previewWrapper?.querySelector('img');

            if (imageInput) {
                imageInput.addEventListener('change', () => {
                    const file = imageInput.files[0];
                    if (!file) return;

                    previewImage.src = URL.createObjectURL(file);
                    previewWrapper.classList.remove('hidden');
                });
            }

        });

        function slugify(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-');
        }
    </script>
@endpush