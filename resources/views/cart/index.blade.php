@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cart->items->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                    <tr>
                        <td class="d-flex align-items-center">
                            @if($item->product->image)
                                <img src="{{ asset('assets/upload/product') . '/' . $item->product->image }}" alt=""
                                    style="width:60px; height:auto; margin-right:10px;">
                            @endif
                            <div>
                                <strong>{{ $item->product->name }}</strong>
                                <div class="text-muted">Product ID: {{ $item->product_id }}</div>
                            </div>
                        </td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" style="display:inline-block;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="0"
                                    style="width:70px; display:inline-block;">
                                <button class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>{{ number_format($item->subtotal, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between m-4">
            <div class="card p-3" style="width:320px;">
                @if ($summary['coupon'] != null)
                    <form action="{{ route('coupon.remove') }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group mb-4">
                            <input type="text" name="code" class="form-control" placeholder="Coupon Code"
                                value="{{ $summary['coupon']->code }}">
                        </div>

                        <button type="submit" class="btn btn-outline-secondary btn-block">Remove Coupon</button>
                    </form>
                @else
                    <form action="{{ route('coupon.apply') }}" method="POST" style="margin-top:8px;">
                        @csrf

                        <div class="form-group mb-4">
                            <input type="text" name="code" class="form-control" placeholder="Coupon Code">
                        </div>

                        <button type="submit" class="btn btn-outline-secondary btn-block">Apply Coupon</button>
                    </form>
                @endif
            </div>

            <div class="card p-3" style="width:320px;">
                <div class="d-flex justify-content-between">
                    <div>Subtotal</div>
                    <div>{{ number_format($summary['subtotal'], 2) }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>discount</div>
                    <div>{{ number_format($summary['discount'], 2) }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>Total</div>
                    <div>{{ number_format($summary['total'], 2) }}</div>
                </div>
                <hr>

                <a href="{{ '#' }}" class="btn btn-success btn-block">Proceed to Checkout</a>

                <form action="{{ route('cart.clear') }}" method="POST" style="margin-top:8px;">
                    @csrf
                    <button class="btn btn-outline-secondary btn-block">Clear Cart</button>
                </form>
            </div>
        </div>
    @endif
    </div>
@endsection