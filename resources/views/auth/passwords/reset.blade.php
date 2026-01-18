<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Tailwind CDN (use Vite in production) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Jost', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">
            Set New Password
        </h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    New Password
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm Password
                </label>
                <input
                    id="password-confirm"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 py-2.5 text-white font-semibold
                       hover:bg-blue-700 transition duration-200"
            >
                Reset Password
            </button>
        </form>

    </div>

</body>
</html>
