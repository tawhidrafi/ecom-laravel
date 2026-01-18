<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>

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
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
            Verify Your OTP
        </h2>

        <!-- OTP Form -->
        <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
            @csrf

            <!-- OTP Input -->
            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700 mb-2 text-left">
                    One-Time Password
                </label>
                <input id="otp" type="text" name="otp" required inputmode="numeric" autocomplete="one-time-code"
                    placeholder="Enter 6-digit OTP" class="w-full text-center tracking-widest text-lg rounded-lg border border-gray-300 px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full rounded-lg bg-blue-600 py-2.5 text-white font-semibold
                       hover:bg-blue-700 transition duration-200">
                Submit
            </button>
        </form>

        <!-- Resend OTP -->
        <div class="mt-6 text-sm text-gray-600">
            <span>Didn't receive the OTP?</span>
            <form method="POST" action="{{ route('otp.resend') }}" class="inline">
                @csrf
                <button type="submit" class="ml-1 text-blue-600 font-medium hover:underline">
                    Resend OTP
                </button>
            </form>
        </div>

    </div>

</body>

</html>