<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'old_price',
        'category_id', 
        'brand',     
        'image',
        'rating',
        'reviews',
        'discount',
        'stock',
        'badges',
        'is_best_seller',
        'is_trending',
        'is_new',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'discount' => 'integer',
        'badges' => 'array',
        'is_best_seller' => 'boolean',
        'is_trending' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function getAverageRatingAttribute()
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    public function getTotalReviewsAttribute()
    {
        return $this->approvedReviews()->count();
    }

    // Existing methods
    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->price, 0);
    }

    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price ? '₹' . number_format($this->old_price, 0) : null;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->old_price && $this->old_price > 0) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBestSellers($query)
    {
        return $query->where('is_best_seller', true);
    }

    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    public function scopeNewArrivals($query)
    {
        return $query->where('is_new', true);
    }
    
    public function getIsInStockAttribute()
    {
        return $this->stock !== 'out_of_stock';
    }
    
    public function getIsLowStockAttribute()
    {
        return $this->stock === 'low';
    }
}