@extends('layouts.admin-app')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupon infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('coupons.index') }}">
                            <div class="text-tiny">Coupons</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Coupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('coupons.update', $coupon) }}">
                    @csrf
                    @method('PUT')

                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <fieldset class="name">
                        <div class="body-title">Coupon Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Name" name="name"
                            value="{{ old('name', $coupon->name) }}" aria-required="true" required>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Code" name="code" tabindex="0"
                            value="{{ old('code', $coupon->code) }}" aria-required="true" required>
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title">Coupon Type</div>
                        <div class="select flex-grow">
                            <select class="" name="type">
                                <option value="">Select</option>
                                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>Percent
                                </option>
                            </select>
                        </div>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Amount <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Amount" name="amount" tabindex="0"
                            value="{{ old('amount', $coupon->amount) }}" aria-required="true" required>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Minimum Purchase <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Cart Value" name="min_purchase" tabindex="0"
                            value="{{ old('min_purchase', $coupon->min_purchase) }}" aria-required="true" required>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Expiry Date <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="date" placeholder="Expiry Date" name="expiry_date" tabindex="0"
                            value="{{ old('expiry_date', $coupon->expiry_date) }}" aria-required="true" required>
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection