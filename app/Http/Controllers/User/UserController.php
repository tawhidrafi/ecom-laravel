<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // dashboard
    public function index()
    {
        return view('user.dashboard');
    }

    // profile
    public function profile()
    {
        return view('user.profile');
    }

    // update 
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . auth()->id(),
            // 'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
