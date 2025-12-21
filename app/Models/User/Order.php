<?php

namespace App\Models\User;

use App\Models\Admin\Coupon;
use App\Models\User;
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
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
