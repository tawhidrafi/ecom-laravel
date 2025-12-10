<?php

namespace App\Models\WishList;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    //
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(WishListItem::class);
    }

    public function hasProduct($productId)
    {
        return $this->items()
            ->where('product_id', $productId)
            ->exists();
    }
}
