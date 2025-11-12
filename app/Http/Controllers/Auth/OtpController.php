<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function show()
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No user found.']);
        }

        if (!$user->otp || $user->otp_expires_at->lt(now())) {
            return back()->withErrors(['otp' => 'OTP expired or not set. Request new OTP.']);
        }

        if (!hash_equals($user->otp, $data['otp'])) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        // OTP ok -> clear and mark optionally a flag (e.g., otp_verified)
        $user->clearOtp();
        $user->email_verified_at = now();
        $user->save();

        // you could set a custom column like otp_verified_at if you want.
        return redirect('/')->with('success', 'OTP verified.');
    }

    public function resend(Request $request)
    {
        $data = $request->validate(['email' => 'required|email']);
        $user = User::where('email', $data['email'])->firstOrFail();

        $otp = $user->generateOtp();
        \Mail::to($user->email)->send(new \App\Mail\OtpMail($user, $otp));

        return back()->with('success', 'OTP resent.');
    }
}