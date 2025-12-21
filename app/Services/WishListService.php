<?php

namespace App\Services;

use App\Models\Admin\Product;
use App\Models\User\WishList;
use Auth;

class WishListService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function getOrCreateWishList(): WishList
    {
        //
        $wishList = $this->user->wishList()->first();

        if (!$wishList) {
            $wishList = $this->user->wishList()->create();
        }

        $wishList->load('items');

        return $wishList;
    }

    public function add(int $productId): WishList
    {
        //
        $product = Product::findOrFail($productId);

        $wishList = $this->getOrCreateWishList();

        $item = $wishList->items()
            ->where('product_id', $productId)
            ->first();

        if (!$item) {
            $wishList->items()->create([
                'product_id' => $product->id
            ]);
        }

        return $wishList->fresh('items');
    }

    public function remove(int $productId): WishList
    {
        //
        $wishList = $this->getOrCreateWishList();

        $wishList->items()->where('product_id', $productId)->delete();

        return $wishList->fresh('items');
    }

    public function clear()
    {
        //
        $wishList = $this->getOrCreateWishList();
        $wishList->items()->delete();
    }
}