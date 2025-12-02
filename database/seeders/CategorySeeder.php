<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'image' => 'cat1.png'],
            ['name' => 'Fashion', 'image' => 'cat2.png'],
            ['name' => 'Home Appliances', 'image' => 'cat3.png'],
            ['name' => 'Computers', 'image' => 'cat4.png'],
            ['name' => 'Sports', 'image' => 'cat5.png'],
            ['name' => 'Health & Beauty', 'image' => 'cat6.png'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'image' => $category['image'],
            ]);
        }
    }
}
