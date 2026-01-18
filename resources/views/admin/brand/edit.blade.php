@extends('layouts.admin-app')

@section('content')
    <div class="p-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Edit Brand</h2>
                <p class="text-sm text-gray-500">Update brand information and logo</p>
            </div>
            <a href="{{ route('brands.index') }}" class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg">
                ← Back
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Left -->
                    <div class="md:col-span-2 space-y-5">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Brand Name
                            </label>
                            <input type="text" name="name" value="{{ old('name', $brand->name) }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('name')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Brand Slug
                            </label>
                            <input type="text" name="slug" value="{{ old('slug', $brand->slug) }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('slug')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Right -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Brand Logo
                        </label>

                        <div class="border-2 border-dashed rounded-xl p-4 text-center">

                            <img id="preview" src="{{ $brand->image
        ? asset('assets/upload/brand/' . $brand->image)
        : 'https://via.placeholder.com/300x200?text=No+Image' }}" class="mx-auto mb-3 max-h-40 object-contain rounded">

                            <label
                                class="inline-block cursor-pointer px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Change Image
                                <input type="file" name="image" id="imageInput" class="hidden">
                            </label>

                            @error('image')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 mt-8">
                    <a href="{{ route('brands.index') }}"
                        class="px-5 py-2 text-sm bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancel
                    </a>
                    <button class="px-6 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Update Brand
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('imageInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
        });
    </script>

@endpush