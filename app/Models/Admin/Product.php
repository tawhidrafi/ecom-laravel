<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'sale_price',
        'stock',
        'featured',
        'in_stock',
        'category_id',
        'brand_id',
        'SKU',
        'image',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\User\Review::class);
    }

    public function averageRating()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }


    public function scopeActive($query)
    {
        //return $query->where('status', 1);
        return $this;
    }

    public function scopeFeatured($query)
    {
        //return $query->where('is_featured', 1);
        return $this;
    }
}
