<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable = [
        'name',
        'code',
        'type',
        'amount',
        'min_purchase',
        'expiry_date'
    ];

    //
    // public function order()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
