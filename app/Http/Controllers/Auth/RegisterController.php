<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Fire Registered event -> Laravel's listener will send verification email if you choose to
        //event(new Registered($user));

        // Optionally: generate OTP and send
        $otp = $user->generateOtp();
        Mail::to($user->email)->send(new OtpMail($user, $otp));

        // Log the user in (optional) or redirect to a page telling them to verify email/OTP
        Auth::login($user);

        //return redirect()->route('verification.notice')->with('success', 'Registration successful. Check email for verification link.');
        return redirect()->route('otp.show')->with('success', 'Registration successful. Check email for OTP.');
    }
}