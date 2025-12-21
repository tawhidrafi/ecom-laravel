@extends('layouts.admin-app')

@section('content')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Order Details</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Order Items</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Ordered Items</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="orders.html">Back</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">SKU</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Brand</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ asset('assets/upload/product') . '/' . $item->product->image }}" alt=""
                                                class="image">
                                        </div>
                                        <div class="name">
                                            <a href="#" target="_blank" class="body-title-2">{{ $item->product->name }}</a>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item->price }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center">{{ $item->product->SKU }}</td>
                                    <td class="text-center">{{ $item->product->category->name }}</td>
                                    <td class="text-center">{{ $item->product->brand->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>

            <div class="wg-box mt-5">
                <h5>Shipping Address</h5>
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__detail">
                        <p>{{ $order->user->name }}</p>
                        <p>{{ $order->address }}</p>
                        <p>{{ $order->city }}</p>
                        <p>{{ $order->state ?? 'N/A' }}</p>
                        <p>{{ $order->zip }}</p>
                        <p>{{ $order->country }}</p>
                        <br>
                        <p>Mobile : {{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="wg-box mt-5">
                <h5>Transactions</h5>
                <table class="table table-striped table-bordered table-transaction">
                    <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>{{ $order->subtotal }}</td>
                            <th>Tax</th>
                            <td>{{ $order->tax }}</td>
                            <th>Discount</th>
                            <td>{{ $order->discount }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{ $order->total }}</td>
                            <th>Payment Mode</th>
                            <td>{{ $order->transaction->method }}</td>
                            <th>Status</th>
                            <td>{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{ $order->created_at }}</td>
                            <th>Delivered Date</th>
                            <td>{{ $order->delivery_date ?? 'Not delivered'}}</td>
                            <th>Canceled Date</th>
                            <td>{{ $order->cancelled_date ?? 'Not canceled' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="wg-box mt-5">
                <h5>Actions</h5>
                <table class="table table-striped table-bordered table-transaction">
                    <tbody>
                        <tr>
                            @if ($order->transaction && $order->transaction->status === 'pending' && $order->status !== 'cancelled')
                                <th>Trx Id/ Reference Id (If any)</th>
                                <form action="{{ route('admin.orders.update-payment-status', $order) }}"
                                    id="payment_status_form" method="POST">
                                    @csrf
                                    @method('put')

                                    <td>
                                        <input type="text" name="trx_id" id="" placeholder="Enter Id">
                                    </td>
                                    <th>Approve / Reject</th>
                                    <td>
                                        <select name="status" id=""
                                            onchange="document.getElementById('payment_status_form').submit()">
                                            <option>Select Any</option>
                                            <option value="approve">Approve</option>
                                            <option value="reject">Reject</option>
                                        </select>
                                    </td>
                                </form>
                            @else
                                <th>Status</th>
                                <td>Payment has been {{ $order->transaction->status }}</td>
                                <th></th>
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Shipping Status</th>
                            <td>{{ $order->delivery_date ?? 'Not delivered' }}</td>
                            @if ($order->status !== 'delivered' && $order->status !== 'cancelled')
                                <form action="{{ route('admin.orders.update-delivery-status', $order) }}"
                                    id="delivery_status_form" method="POST">
                                    @csrf
                                    @method('put')

                                    <th>Processing / Shipped / Delivered</th>
                                    <td>
                                        <select name="status" id=""
                                            onchange="document.getElementById('delivery_status_form').submit()">
                                            <option>Select Any</option>
                                            <option value="processing">Processing</option>
                                            <option value="shipped">Shipped</option>
                                            <option value="delivered">Delivered</option>
                                        </select>
                                    </td>
                                </form>
                            @else
                                <th></th>
                                <td></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection