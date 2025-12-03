<?php

namespace App\Models\Cart;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->subtotal;
        });
    }

    public function getCountAttribute()
    {
        return $this->items->sum('quantity');
    }

    public function hasProduct($productId)
    {
        return $this->items()
            ->where('product_id', $productId)
            ->exists();
    }

}
