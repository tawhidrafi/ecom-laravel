<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>OTP Verification</title>
</head>

<body>
    <p>Hello {{ $user->name }},</p>
    <p>Your OTP code is: <strong>{{ $otp }}</strong></p>
    <p>This code will expire in 10 minutes.</p>
</body>

</html>