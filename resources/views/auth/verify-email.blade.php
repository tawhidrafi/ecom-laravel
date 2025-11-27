<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset("assets/front/css/style.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset("assets/front/css/custom.css") }}" type="text/css" />
</head>

<body>
    <main class="pt-90">
        <section class="login-register container">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <h2>Verify Your Email Address</h2>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="otp-tab">

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

                    <form method="POST" action="{{ route('verification.send') }}" class="needs-validation" novalidate>
                        @csrf
                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Resend Verification
                            Email</button>
                    </form>

                    <div class="pb-3"></div>

                    <p><a href="{{ route('login') }}">Back to Login</a></p>

                </div>
            </div>
        </section>
    </main>

</body>

</html>