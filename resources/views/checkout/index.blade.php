@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Shipping and Checkout</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="#" class="checkout-steps__item active">
                    <div>
                        <span class="checkout-steps__item-number">02</span>
                        <span class="checkout-steps__item-title">
                            <span>Shipping and Checkout</span>
                            <em>Checkout Your Items List</em>
                        </span>
                    </div>
                    <a href="#" class="checkout-steps__item">
                        <span class="checkout-steps__item-number">03</span>
                        <span class="checkout-steps__item-title">
                            <span>Confirmation</span>
                            <em>Review And Submit Your Order</em>
                        </span>
                    </a>
            </div>
            <form name="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>SHIPPING DETAILS</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" disabled value="{{ auth()->user()->name }}">
                                    <label for="name">Full Name</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="phone" required="">
                                    <label for="phone">Phone Number *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="address" required=""
                                        value="{{ $address ? $address->address : '' }}">
                                    <label for="address">Address Line *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="city" required=""
                                        value="{{ $address ? $address->city : '' }}">
                                    <label for="city">Town / City *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="zip" required=""
                                        value="{{ $address ? $address->zip : '' }}">
                                    <label for="zip">Zipcode *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="country" required=""
                                        value="{{ $address ? $address->country : '' }}">
                                    <label for="country">Country *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Your Order</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th align="right">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->items as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->product->name }} x {{ $item->quantity }}
                                                </td>
                                                <td align="right">
                                                    ${{ $item->subtotal }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td align="right">${{ $cart->total }}</td>
                                        </tr>
                                        <tr>
                                            <th>SHIPPING</th>
                                            <td align="right">Free shipping</td>
                                        </tr>
                                        <tr>
                                            <th>Discount</th>
                                            <td align="right">{{ $summary['discount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>TAX / VAT</th>
                                            <td align="right">N / A</td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL</th>
                                            <td align="right">${{ $summary['total'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__payment-methods">
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="method"
                                        id="checkout_payment_method_1" value="bank">
                                    <label class="form-check-label" for="checkout_payment_method_1">
                                        Direct bank transfer
                                        <p class="option-detail">
                                            Make your payment directly into our bank account. Please use your Order ID as
                                            the payment reference.Your order will not be shipped until the funds have
                                            cleared in our account.
                                            Account Name: XYZ,
                                            Account Number: 123456789,
                                            Bank Name: ABC Bank,
                                            SWIFT Code: ABCD1234
                                        </p>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="method"
                                        id="checkout_payment_method_3" value="cod">
                                    <label class="form-check-label" for="checkout_payment_method_3">
                                        Cash on delivery
                                        <p class="option-detail">
                                            Recieve your order at home and pay in cash to the courier.
                                        </p>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="method"
                                        id="checkout_payment_method_4" value="bkash/nagad">
                                    <label class="form-check-label" for="checkout_payment_method_4">
                                        Mobile Banking (Bkash/Nagad)
                                        <p class="option-detail">
                                            Make your payment via Bkash or Nagad to the following number: 01XXXXXXXXX.
                                            Please include your Order ID in the payment reference. Your order will be
                                            processed once the payment is confirmed.
                                        </p>
                                    </label>
                                </div>
                                <div class="policy-text">
                                    Your personal data will be used to process your order, support your experience
                                    throughout this
                                    website, and for other purposes described in our <a href="terms.html"
                                        target="_blank">privacy
                                        policy</a>.
                                </div>
                            </div>
                            <button class="btn btn-primary btn-checkout" type="submit">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection