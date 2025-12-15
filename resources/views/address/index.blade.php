@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Addresses</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="my-account.html" class="menu-link menu-link_us-s menu-link_active">Dashboard</a></li>
                        <li><a href="account-orders.html" class="menu-link menu-link_us-s">Orders</a></li>
                        <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
                        <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
                        <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li>
                        <li><a href="login.html" class="menu-link menu-link_us-s">Logout</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__address">
                        <div class="row">
                            <div class="text-right">
                                <a href="{{ route('address.create') }}" class="btn btn-sm btn-info">Add New</a>
                            </div>
                        </div>
                        <div class="my-account__address-list row">
                            <h5>Shipping Address</h5>

                            @foreach ($addresses as $address)
                                <div class="my-account__address-item col-md-6">
                                    <div class="my-account__address-item__title">
                                        <h5>{{ $address->title }} <i class="fa fa-check-circle text-success"></i></h5>
                                        <a href="{{ route('address.edit', $address) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('address.destroy', $address) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>

                                    <div class="my-account__address-item__detail">
                                        <p>Address: {{ $address->address }}</p>
                                        <p>City: {{ $address->city }}</p>
                                        <p>State: {{ $address->state ?? 'N/A' }}</p>
                                        <p>Zipcode: {{ $address->zip }}</p>
                                        <p>Country: {{ $address->country }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection