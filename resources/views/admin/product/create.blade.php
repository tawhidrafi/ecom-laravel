@extends('layouts.admin-app')

@section('content')
    <div class="p-6 max-w-full mx-auto space-y-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-2xl font-semibold text-gray-800">Add Product</h2>
            <ul class="flex items-center space-x-2 text-gray-500 text-sm">
                <li><a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a></li>
                <li>/</li>
                <li><a href="{{ route('products.index') }}" class="hover:underline">Products</a></li>
                <li>/</li>
                <li>Add</li>
            </ul>
        </div>

        <!-- Form -->
        <form method="POST" enctype="multipart/form-data" action="{{ route('products.store') }}"
            class="space-y-6 bg-white p-6 rounded shadow">
            @csrf

            <!-- Product Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Product Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full border px-3 py-2 rounded focus:ring focus:border-gray-300" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Slug <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        class="w-full border px-3 py-2 rounded focus:ring focus:border-gray-300" required>
                    @error('slug') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" class="w-full border px-3 py-2 rounded focus:ring focus:border-gray-300"
                        required>
                        <option value="">Choose category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Brand <span class="text-red-500">*</span></label>
                    <select name="brand_id" class="w-full border px-3 py-2 rounded focus:ring focus:border-gray-300"
                        required>
                        <option value="">Choose brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Descriptions -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Short Description <span
                        class="text-red-500">*</span></label>
                <textarea name="short_description" rows="3"
                    class="w-full border px-3 py-2 rounded focus:ring focus:border-gray-300"
                    required>{{ old('short_description') }}</textarea>
                @error('short_description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="5"
                    class="w-full border px-3 py-2 rounded focus:ring focus:border-gray-300"
                    required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Main Image</label>
                    <img id="mainImagePreview" class="mb-2 w-32 h-32 object-cover rounded hidden">
                    <input type="file" name="image" id="mainImage" accept="image/*">
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Gallery Images</label>
                    <input type="file" name="images[]" id="galleryImages" accept="image/*" multiple>
                    @error('images') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Pricing and Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Regular Price</label>
                    <input type="text" name="regular_price" value="{{ old('regular_price') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Sale Price</label>
                    <input type="text" name="sale_price" value="{{ old('sale_price') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">SKU</label>
                    <input type="text" name="SKU" value="{{ old('SKU') }}" class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="text" name="quantity" value="{{ old('quantity') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Stock Status</label>
                    <select name="stock_status" class="w-full border px-3 py-2 rounded">
                        <option value="instock">In Stock</option>
                        <option value="outofstock">Out of Stock</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Featured</label>
                    <select name="featured" class="w-full border px-3 py-2 rounded">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="w-full bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">Add
                Product</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto-slug
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        nameInput.addEventListener('input', () => {
            let slug = nameInput.value.trim().toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
        });

        // Main image preview
        const mainImageInput = document.getElementById('mainImage');
        const mainImagePreview = document.getElementById('mainImagePreview');
        mainImageInput.addEventListener('change', e => {
            const file = e.target.files[0];
            if (file) {
                mainImagePreview.src = URL.createObjectURL(file);
                mainImagePreview.classList.remove('hidden');
            }
        });

        // Gallery preview
        const galleryInput = document.getElementById('galleryImages');
        galleryInput.addEventListener('change', e => {
            const container = document.createElement('div');
            container.className = 'flex flex-wrap gap-2 mb-2';
            const files = e.target.files;
            Array.from(files).forEach(file => {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'w-24 h-24 object-cover rounded';
                container.appendChild(img);
            });
            galleryInput.parentNode.insertBefore(container, galleryInput);
        });
    </script>
@endpush