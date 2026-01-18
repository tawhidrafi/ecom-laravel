@extends('layouts.admin-app')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Edit Coupon</h2>
                <p class="text-sm text-gray-500">Update the details of your coupon</p>
            </div>
            <a href="{{ route('coupons.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg text-sm hover:bg-gray-300">
                ← Back to Coupons
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow p-6">
            <form method="POST" action="{{ route('coupons.update', $coupon) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Coupon Name -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Coupon Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $coupon->name) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Coupon Name" required>
                </div>

                <!-- Coupon Code -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Coupon Code <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="code" value="{{ old('code', $coupon->code) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Coupon Code" required>
                </div>

                <!-- Coupon Type -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Coupon Type</label>
                    <select name="type"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Select</option>
                        <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percent
                        </option>
                    </select>
                </div>

                <!-- Amount -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Amount <span class="text-red-500">*</span></label>
                    <input type="number" name="amount" value="{{ old('amount', $coupon->amount) }}" step="0.01"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Coupon Amount" required>
                </div>

                <!-- Minimum Purchase -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Minimum Purchase <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="min_purchase" value="{{ old('min_purchase', $coupon->min_purchase) }}"
                        step="0.01"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Cart Value" required>
                </div>

                <!-- Expiry Date -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Expiry Date <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $coupon->expiry_date) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection