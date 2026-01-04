@extends('layouts.app')

@section('content')
  <main class="min-h-screen flex items-center justify-center bg-gray-100 py-12">
  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

    @if (session('message'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
        {{ session('message') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition">
        Log In
      </button>
    </form>

    <div class="mt-6 text-center text-gray-600 text-sm">
      <span>No account yet?</span>
      <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Create Account</a>
      <span> | </span>
      <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Reset Password</a>
    </div>
  </div>
</main>

@endsection