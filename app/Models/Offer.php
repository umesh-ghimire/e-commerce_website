<?php
// app/Models/Offer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'discount',
        'type',
        'expires_at',
        'is_active',
        'used_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
        'is_active' => 'boolean',
        'discount' => 'decimal:2',
    ];

    /**
     * Get the user that owns the offer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if offer is valid.
     */
    public function isValid()
    {
        return $this->is_active && 
               !$this->used_at && 
               $this->expires_at > now();
    }

    /**
     * Mark offer as used.
     */
    public function markAsUsed()
    {
        $this->update([
            'used_at' => now(),
            'is_active' => false,
        ]);
    }

    /**
     * Get formatted discount.
     */
    public function getFormattedDiscountAttribute()
    {
        if ($this->type === 'percentage') {
            return $this->discount . '% OFF';
        }
        return '₹' . number_format($this->discount, 2) . ' OFF';
    }
}