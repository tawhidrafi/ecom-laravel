<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_id' => 9,
                'brand_id' => 8,
                'name' => 'Wireless Headphones',
                'image' => '1.jpg',
                'gallery' => ['1a.jpg', '1b.jpg'],
                'price' => 120.00,
                'sale_price' => 99.00,
                'stock' => 50,
                'featured' => true,
            ],
            [
                'category_id' => 12,
                'brand_id' => 8,
                'name' => 'Bluetooth Speaker',
                'image' => '2.jpg',
                'gallery' => ['2a.jpg', '2b.jpg'],
                'price' => 80.00,
                'sale_price' => null,
                'stock' => 30,
                'featured' => false,
            ],
            [
                'category_id' => 13,
                'brand_id' => 7,
                'name' => 'Smart Watch',
                'image' => '3.jpg',
                'gallery' => ['3a.jpg', '3b.jpg'],
                'price' => 150.00,
                'sale_price' => 130.00,
                'stock' => 70,
                'featured' => true,
            ],
            [
                'category_id' => 10,
                'brand_id' => 6,
                'name' => 'DSLR Camera',
                'image' => '4.jpg',
                'gallery' => ['4a.jpg', '4b.jpg'],
                'price' => 500.00,
                'sale_price' => null,
                'stock' => 10,
                'featured' => false,
            ],
            [
                'category_id' => 11,
                'brand_id' => 5,
                'name' => 'Gaming Mouse',
                'image' => '5.jpg',
                'gallery' => ['5a.jpg', '5b.jpg'],
                'price' => 45.00,
                'sale_price' => 35.00,
                'stock' => 200,
                'featured' => false,
            ]
        ];

        foreach ($products as $p) {
            Product::create([
                'category_id' => $p['category_id'],
                'brand_id' => $p['brand_id'],
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'SKU' => 'SKU-' . strtoupper(Str::random(6)),
                'short_description' => 'Short description for ' . $p['name'],
                'description' => 'Full detailed description for ' . $p['name'],
                'image' => $p['image'],
                'images' => $p['gallery'],
                'price' => $p['price'],
                'sale_price' => $p['sale_price'],
                'stock' => $p['stock'],
                'in_stock' => $p['stock'] > 0,
                'featured' => $p['featured'],
            ]);
        }
    }
}
