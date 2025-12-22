<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // contact form
    public function index()
    {
        return view('user.contact');
    }

    // submit message
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'required|string|max:20|unique:contacts,phone',
            'message' => 'required|string',
        ]);

        \App\Models\User\Contact::create($validated);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
