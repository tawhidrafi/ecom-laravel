<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Samsung', 'image' => 'brand1.jpg'],
            ['name' => 'Apple', 'image' => 'brand2.jpg'],
            ['name' => 'Sony', 'image' => 'brand3.jpg'],
            ['name' => 'Xiaomi', 'image' => 'brand4.jpg'],
            ['name' => 'HP', 'image' => 'brand5.jpg'],
            ['name' => 'Logitech', 'image' => 'brand6.jpg'],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'image' => $brand['image'],
            ]);
        }
    }
}
