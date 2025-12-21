@extends('layouts.app')

@section('content')
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Order's Details</h2>
            <div class="row">
                <div class="col-lg-2">
                    <ul class="account-nav">
                        <li><a href="{{ route('user.dashboard') }}" class="menu-link menu-link_us-s">Dashboard</a></li>
                        <li><a href="{{ route('user.orders.index') }}"
                                class="menu-link menu-link_us-s menu-link_active">Orders</a></li>
                        <li><a href="{{ route('address.index') }}" class="menu-link menu-link_us-s ">Addresses</a></li>
                        <li><a href="#" class="menu-link menu-link_us-s ">Account
                                Details</a></li>
                        <li><a href="{{ route('wishlist.index') }}" class="menu-link menu-link_us-s ">Wishlist</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form-1">
                                @csrf

                                <button type="submit">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10">
                    <div class="wg-box mt-5 mb-5">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Details</h5>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-sm btn-danger" href="http://localhost:8000/account-orders">Back</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-transaction">
                                <tbody>
                                    <tr>
                                        <th>Order No</th>
                                        <td>{{ $order->id }}</td>
                                        <th>Mobile</th>
                                        <td>{{ $order->phone }}</td>
                                        <th>Pin/Zip Code</th>
                                        <td>{{ $order->zip }}</td>
                                    </tr>
                                    <tr>
                                        <th style="color: black">Order Date</th>
                                        <td>{{ $order->created_at }}</td>
                                        <th style="color: black">Delivered Date</th>
                                        <td>{{ $order->delivery_date ?? 'pending' }}</td>
                                        <th style="color: black">Canceled Date</th>
                                        <td>{{ $order->cancelled_date ?? 'Not Canceled' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td colspan="5">{{ $order->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="wg-box wg-table table-all-user">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Items</h5>
                            </div>
                            <div class="col-6 text-right">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">SKU</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Brand</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="pname">
                                                <div class="image">
                                                    <img src="{{ asset('assets/upload/product') . '/' . $item->product->image }}"
                                                        alt="" class="image"
                                                        style="width:60px; height:auto; margin-right:10px;">
                                                </div>
                                                <div class="name">
                                                    <a href="{{ route('shop.show', $item->product->slug) }}" target="_blank"
                                                        class="body-title-2">{{ $item->product->name }}</a>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $item->product->SKU }}</td>
                                            <td class="text-center">{{ $item->product->category->name }}</td>
                                            <td class="text-center">{{ $item->product->brand->name }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">${{ $item->price }}</td>
                                            <td class="text-center">${{ $item->subtotal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                    </div>

                    <div class="wg-box mt-5">
                        <h5>Shipping Address</h5>
                        <div class="my-account__address-item col-md-6">
                            <div class="my-account__address-item__detail">
                                <p>Address: {{ $order->address }}</p>
                                <p>City: {{ $order->city }}</p>
                                <p>State: {{ $order->state ?? 'N/A' }}</p>
                                <p>Zipcode: {{ $order->zip }}</p>
                                <p>Country: {{ $order->country }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="wg-box mt-5">
                        <h5>Transactions</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-transaction">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>${{ $order->subtotal }}</td>
                                        <th>Tax</th>
                                        <td>${{ $order->tax ?? 0 }}</td>
                                        <th>Discount</th>
                                        <td>${{ $order->discount ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <th style="color: black">Total</th>
                                        <td>${{ $order->total }}</td>
                                        <th style="color: black">Payment Mode</th>
                                        <td>{{ $order->transaction->method }}</td>
                                        <th style="color: black">Status</th>
                                        <td>
                                            {{ $order->transaction->status }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($order->cancelled_date === null && $order->status !== 'delivered')
                        <div class="wg-box mt-5 text-right">
                            <form action="{{ route('user.order.cancel', $order) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Cancel Order</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection