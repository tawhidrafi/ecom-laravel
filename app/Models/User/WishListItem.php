<?php

namespace App\Models\User;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;

class WishListItem extends Model
{
    protected $fillable = ['wish_list_id', 'product_id'];

    public function cart()
    {
        return $this->belongsTo(WishList::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
