<?php
// app/Models/Address.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'is_default',
        'type', // home, work, other
        'phone',
        'recipient_name',
    ];
    
    protected $casts = [
        'is_default' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getFullAddressAttribute()
    {
        $address = $this->address_line1;
        if ($this->address_line2) {
            $address .= ', ' . $this->address_line2;
        }
        $address .= ', ' . $this->city . ', ' . $this->state . ' - ' . $this->postal_code;
        $address .= ', ' . $this->country;
        
        return $address;
    }
}