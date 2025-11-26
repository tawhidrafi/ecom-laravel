<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function index()
    {
        // If already verified, redirect
        if (Auth::user()->email_verified_at !== null) {
            return redirect()->route('home');
        }

        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'otp' => 'required|string',
        ]);

        // catch user email from Auth
        $email = Auth::user()->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found.']);
        }
        if (!$user->otp || $user->otp_expires_at->lt(now())) {
            return back()->withErrors(['otp' => 'OTP expired or not set. Request new OTP.']);
        }
        if (!hash_equals($user->otp, $data['otp'])) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        // OTP ok
        $user->clearOtp();
        $user->email_verified_at = now();
        $user->save();

        return redirect('/')->with('success', 'OTP verified.');
    }

    public function resend()
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email)->firstOrFail();

        $otp = $user->generateOtp();
        \Mail::to($user->email)->send(new \App\Mail\OtpMail($user, $otp));

        return back()->with('success', 'OTP resent.');
    }
}