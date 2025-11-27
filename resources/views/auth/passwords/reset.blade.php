</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

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
                    <a class="nav-link active" data-bs-toggle="tab" href="#otp-tab">Set New Password</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="otp-tab">

                    @if ($errors->any())
                        <div style="color:red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" class=" needs-validation" novalidate>
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Email"
                            required hidden>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control form-control_gray " name="password"
                                required="" autocomplete="new-password">
                            <label for="password">Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password-confirm" type="password" class="form-control form-control_gray"
                                name="password_confirmation" required="" autocomplete="new-password">
                            <label for="password">Confirm Password</label>
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Reset</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

</body>

</html>