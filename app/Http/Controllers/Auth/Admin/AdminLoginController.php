<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (
            Auth::guard('admin')->attempt(
                $request->only('email', 'password'),
                $request->filled('remember')
            )
        ) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
