<!-- resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
</head>

<body>
    <h2>Verify Your Email Address</h2>

    @if (session('message'))
        <div style="color:green;">
            {{ session('message') }}
        </div>
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

    <p>
        Before proceeding, please check your email for a verification link.
        If you did not receive the email, you can request another one below.
    </p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>

    <p><a href="{{ route('login') }}">Back to Login</a></p>
</body>

</html>