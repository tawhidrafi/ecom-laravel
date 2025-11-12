<!-- resources/views/auth/register.blade.php -->
<form method="POST" action="{{ route('register') }}">
    @csrf
    <input name="name" value="{{ old('name') }}" placeholder="Name" required />
    <input name="email" value="{{ old('email') }}" placeholder="Email" required />
    <input name="password" type="password" placeholder="Password" required />
    <input name="password_confirmation" type="password" placeholder="Confirm password" required />
    <button type="submit">Register</button>
</form>