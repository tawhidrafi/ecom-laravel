@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex flex-col md:flex-row gap-8">

      <aside class="w-full md:w-64 flex-shrink-0">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 md:p-6 mb-4">
          <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-100">
            <img src="https://picsum.photos/seed/user1/100/100" alt="Avatar" class="w-12 h-12 rounded-full object-cover">
            <div>
              <h3 class="font-bold text-gray-900">{{ auth()->user()->name }}</h3>
            </div>
          </div>

          <nav class="hidden md:block space-y-1">
            <a href="{{ route('user.dashboard') }}"
              class="nav-btn w-full text-left px-4 py-3 rounded-md text-sm font-medium bg-gray-50 text-primary border-l-4 border-accent">
              <i class="fa-solid fa-chart-pie w-6 text-center mr-2"></i> Overview
            </a>
            <a href="{{ route('user.orders.index') }}"
              class="block w-full text-left px-4 py-3 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary transition">
              <i class="fa-solid fa-box w-6 text-center mr-2"></i> My Orders
            </a>
            <a href="{{ route('user.profile') }}"
              class="nav-btn w-full text-left px-4 py-3 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary transition">
              <i class="fa-regular fa-user w-6 text-center mr-2"></i> Profile Details
            </a>
            <form action="{{ route('logout') }}" method="POST" class="header-tools__item">
              @csrf
              <button type="submit" style="background: crimson; color: aliceblue; border: none; padding: 0.5rem; cursor: pointer; margin-left: 1.25rem; margin-top: 1rem;">
                Logout
              </button>
            </form>
          </nav>

          <div class="md:hidden flex overflow-x-auto space-x-2 pb-2 no-scrollbar">
            <a href="{{ route('user.dashboard') }} class=" nav-btn-mobile whitespace-nowrap px-4 py-2 rounded-full text-xs
              font-medium bg-primary text-white">Overview</a>
            <a href="{{ route('user.orders.index') }}"
              class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Orders</a>
            <a href="{{ route('user.profile') }}"
              class="nav-btn-mobile whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Profile</a>
          </div>
        </div>
      </aside>

      <div class="flex-1">
        <div id="overview" class="tab-content">
          <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Overview</h1>
            <p class="text-gray-500 text-sm">Welcome back</p>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 font-semibold uppercase">Total Orders</p>
              <p class="text-2xl font-bold text-gray-900 mt-1">{{ auth()->user()->orders->count() }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 font-semibold uppercase">Shopping amount</p>
              <p class="text-2xl font-bold text-gray-900 mt-1">{{ auth()->user()->orders->sum('total') }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 font-semibold uppercase">Loyalty Points</p>
              <p class="text-2xl font-bold text-accent mt-1">Coming Soon</p>
            </div>
          </div>

          {{-- <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-lg font-bold text-gray-900">Recent Activity</h2>
              <a href="my-orders.html" class="text-sm text-accent hover:underline">View All</a>
            </div>
            <div class="flex flex-col md:flex-row gap-6 items-center bg-gray-50 p-4 rounded-lg border border-gray-100">
              <div
                class="w-full md:w-16 h-16 bg-white border border-gray-200 rounded flex items-center justify-center text-2xl">
                <i class="fa-solid fa-truck-fast text-accent"></i>
              </div>
              <div class="flex-1">
                <p class="font-bold text-gray-900">Order #LUM-2890 is on the way!</p>
                <p class="text-sm text-gray-500">Estimated delivery: Oct 30, 2023</p>
              </div>
              <a href="order-details.html"
                class="text-sm font-bold text-white bg-primary hover:bg-gray-800 px-4 py-2 rounded transition">Track
                Order</a>
            </div>
          </div> --}}

        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script></script>
@endpush