@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Account Details</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{ route('user.dashboard') }}" class="menu-link menu-link_us-s">Dashboard</a></li>
                        <li><a href="{{ route('user.orders.index') }}" class="menu-link menu-link_us-s">Orders</a>
                        </li>
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
                <div class="col-lg-9">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form name="account_edit_form" action="{{ route('user.profile.update') }}" method="POST"
                                class="needs-validation" novalidate="">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" placeholder="Full Name" name="name"
                                                value="{{ auth()->user()->name }}">
                                            <label for="name">Name</label>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" placeholder="Mobile Number" name="phone"
                                                value="{{ auth()->user()->phone }}">
                                            <label for="phone">Mobile Number</label>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="email" class="form-control" placeholder="Email Address"
                                                name="email" value="{{ auth()->user()->email }}">
                                            <label for="account_email">Email Address</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <h5 class="text-uppercase mb-0">Password Change</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="form-control" id="new_password" name="password"
                                                placeholder="New password" required="">
                                            <label for="account_new_password">New password</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="form-control" cfpwd="" data-cf-pwd="#new_password"
                                                id="new_password_confirmation" name="password_confirmation"
                                                placeholder="Confirm new password" required="">
                                            <label for="new_password_confirmation">Confirm new password</label>
                                            <div class="invalid-feedback">Passwords did not match!</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection