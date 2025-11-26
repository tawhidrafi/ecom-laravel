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
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}" type="text/css" />
</head>

<body>
    <main class="pt-90">
        <section class="login-register container">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#otp-tab">Verify your OTP</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="otp-tab">

                    <form method="POST" action="{{ route('otp.verify') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="otp" type="text" class="form-control form-control_gray" name="otp" required>
                            <label for="otp">OTP</label>
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Submit</button>
                    </form>

                    <div class="pb-3"></div>
                    
                    <div class="customer-option mt-4 text-center">
                        <span class="text-secondary">Didn't receive OTP?</span>
                        <form method="POST" action="{{ route('otp.resend') }}">
                            @csrf
                            <button>Resend OTP</button>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </main>

</body>

</html>
