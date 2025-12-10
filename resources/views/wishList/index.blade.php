@extends('layouts.app')

@section('content')
    <h1>Your WishList</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
        <p>Your wishList is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="d-flex align-items-center">
                            @if($item->product->image)
                                <img src="{{ asset('assets/upload/product') . '/' . $item->product->image }}" alt=""
                                    style="width:60px; height:auto; margin-right:10px;">
                            @endif
                            <div>
                                <strong>{{ $item->product->name }}</strong>
                            </div>
                        </td>
                        <td>
                            @if($item->product->sale_price)
                                <s> ${{ $item->product->price }} </s> ${{ $item->product->sale_price }}
                            @else
                                ${{ $item->product->price }}
                            @endif
                        </td>
                        <td class="flex">
                            <div style="display: inline-block; margin-right: 25px;">
                                <form action="{{ route('wishlist.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </div>

                            <div style="display: inline-block">
                                @if($cart->hasProduct($item->product_id))
                                    <a href="{{ route('cart.index') }}">
                                        <button type="submit" class="btn btn-primary">View Cart</button>
                                    </a>
                                @else
                                    <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                        @csrf

                                        <div>
                                            <input type="number" name="quantity" value="1" min="1" hidden>
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">Add to
                                                Cart</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    </div>
@endsection