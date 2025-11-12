<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
</head>

<body>
    <h2>Reset Password</h2>

    @if (session('status'))
        <div style="color:green;">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Send Password Reset Link</button>
    </form>
    <a href="{{ route('login') }}">Back to Login</a>
</body>

</html>