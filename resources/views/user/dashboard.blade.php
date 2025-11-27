@extends('layouts.app')

@section('content')
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Account</h2>
      <div class="row">
        <div class="col-lg-3">
          <ul class="account-nav">
            <li><a href="{{ route('user.dashboard') }}" class="menu-link menu-link_us-s">Dashboard</a></li>
            <li><a href="account-orders.html" class="menu-link menu-link_us-s">Orders</a></li>
            <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
            <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
            <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li>
            <li><a href="login.html" class="menu-link menu-link_us-s">Logout</a></li>
          </ul>
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            <p>Hello <strong>{{ ucfirst(Auth::user()->name) }}</strong></p>
            <p>
              More features coming soon
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection