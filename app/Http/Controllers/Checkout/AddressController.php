<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Checkout\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth()->user();
    }
    // index
    public function index()
    {
        $addresses = $this->user->addresses;

        return view('address.index', compact('addresses'));
    }
    // create
    public function create()
    {
        return view('address.create');
    }
    // store 
    public function store(Request $request)
    {
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            // 'is_default' => 'sometimes|boolean',
        ]);

        $address = new Address();

        $address->user_id = $this->user->id;
        $address->title = $validated['title'];
        $address->address = $validated['address'];
        $address->city = $validated['city'];
        $address->state = $validated['state'] ?? null;
        $address->country = $validated['country'];
        $address->zip = $validated['zip'];
        $address->is_default = $request->boolean('is_default');

        $address->save();

        return redirect()->route('address.index')->with('success', 'Address created successfully.');
    }
    // edit 
    public function edit(Address $address)
    {
        return view('address.edit', compact('address'));
    }
    // update 
    public function update(Address $address)
    {
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            // 'is_default' => 'nullable|boolean',
        ]);

        $address->title = $validated['title'];
        $address->address = $validated['address'];
        $address->city = $validated['city'];
        $address->state = $validated['state'];
        $address->country = $validated['country'];
        $address->zip = $validated['zip'];
        // $address->is_default = $validated['is_default'];

        $address->save();

        return redirect()->route('address.index')->with('success', 'Address updated successfully.');
    }
    // destroy 
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('address.index')->with('success', 'Address deleted successfully.');
    }
}