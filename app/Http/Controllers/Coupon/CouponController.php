<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use App\Models\Coupon\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // index page
    public function index()
    {
        $coupons = Coupon::orderBy('expiry_date', 'asc')->paginate(10);

        return view('admin.coupon.index', compact('coupons'));
    }
    // create page
    public function create()
    {
        return view('admin.coupon.create');
    }
    // store
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons,code',
            'type' => 'required|in:fixed,percentage',
            'amount' => 'required|numeric|min:0',
            'min_purchase' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
        ]);

        $coupon = new Coupon();

        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->min_purchase = $request->min_purchase;
        $coupon->expiry_date = $request->expiry_date;

        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }
    // edit page
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', compact('coupon'));
    }
    // update 
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percentage',
            'amount' => 'required|numeric|min:0',
            'min_purchase' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
        ]);

        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->min_purchase = $request->min_purchase;
        $coupon->expiry_date = $request->expiry_date;

        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }
    // delete
    public function destroy(Coupon $coupon)
    {
        //
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
