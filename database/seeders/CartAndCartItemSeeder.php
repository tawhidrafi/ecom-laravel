<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product;

class CartAndCartItemSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        foreach (User::all() as $user) {
            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
            ]);

            // Add 2 random products
            for ($i = 0; $i < 2; $i++) {

                $product = $products->random();
                $price = $product->sale_price ?? $product->price;
                $qty = rand(1, 3);

                CartItem::updateOrCreate(
                    [
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                    ],
                    [
                        'quantity' => $qty,
                        'price' => $price,
                    ]
                );
            }
        }
    }

}
