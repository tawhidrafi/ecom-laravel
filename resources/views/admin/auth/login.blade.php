<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset("assets/admin/css/style.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset("assets/admin/css/animate.min.css") }}" type="text/css" />
</head>

<body>
    <main class="pt-90">
        <section class="login-register container">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#otp-tab">Admin Login</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="otp-tab">

                    <form method="POST" action="{{ route('admin.login.post') }}" class="needs-validation" novalidate>
                        @csrf

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

                        <div class="form-floating mb-3">
                            <input class="form-control form-control_gray" type="email" name="email"
                                value="{{ old('email') }}" required="" autocomplete="email" autofocus="">
                            <label for="email">Email address</label>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control form-control_gray" name="password"
                                required="" autocomplete="current-password">
                            <label for="customerPasswodInput">Password</label>
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Log In</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

</body>

</html>