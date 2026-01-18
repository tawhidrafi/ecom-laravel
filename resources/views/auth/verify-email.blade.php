<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>

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

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 text-center">

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            Verify Your Email Address
        </h2>

        <!-- Success Message -->
        @if (session('message'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4">
                <p class="text-sm text-green-700">
                    {{ session('message') }}
                </p>
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4 text-left">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Instructions -->
        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
            Before proceeding, please check your email for a verification link.
            If you did not receive the email, you can request another one below.
        </p>

        <!-- Resend Button -->
        <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
            @csrf
            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 py-2.5 text-white font-semibold
                       hover:bg-blue-700 transition duration-200"
            >
                Resend Verification Email
            </button>
        </form>

        <!-- Back to Login -->
        <a
            href="{{ route('login') }}"
            class="text-sm text-blue-600 hover:underline"
        >
            Back to Login
        </a>

    </div>

</body>
</html>
