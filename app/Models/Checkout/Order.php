<?php

namespace App\Models\Checkout;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'coupon_id',
        'phone',
        'subtotal',
        'tax',
        'shipping',
        'discount',
        'total',
        'address_id',
        'address',
        'city',
        'zip',
        'country',
        'delivery_date',
        'cancelled_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Models\Checkout\OrderItem');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon');
    }

    public function transaction()
    {
        return $this->hasOne('App\Models\Checkout\Transaction');
    }
}
