<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input name="email" placeholder="Email" required />
    <input name="otp" placeholder="OTP" required />
    <button>Verify OTP</button>
</form>

<form method="POST" action="{{ route('otp.resend') }}">
    @csrf
    <input name="email" placeholder="Email" />
    <button>Resend OTP</button>
</form>