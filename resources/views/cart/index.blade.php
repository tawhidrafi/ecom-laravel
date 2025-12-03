@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
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
                @foreach($items as $item)
                    <tr>
                        <td class="d-flex align-items-center">
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="" style="width:60px; height:auto; margin-right:10px;">
                            @endif
                            <div>
                                <strong>{{ $item->name }}</strong>
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

        <div class="d-flex justify-content-end">
            <div class="card p-3" style="width:320px;">
                <div class="d-flex justify-content-between">
                    <div>Subtotal</div>
                    <div>{{ number_format($total, 2) }}</div>
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