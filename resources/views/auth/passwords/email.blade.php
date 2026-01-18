<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

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
            Reset Password
        </h2>

        <!-- Status Message -->
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4">
                <p class="text-sm text-green-700">
                    {{ session('status') }}
                </p>
            </div>
        @endif

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
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="you@example.com"
                >
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 py-2.5 text-white font-semibold
                       hover:bg-blue-700 transition duration-200"
            >
                Send Password Reset Link
            </button>
        </form>

    </div>

</body>
</html>
