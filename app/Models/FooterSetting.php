<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_description',
        'logo',
        'email',
        'phone',
        'address',
        'copyright_text',
        'newsletter_title',
        'newsletter_description',
        'show_newsletter',
        'primary_color',
        'secondary_color'
    ];

    protected $casts = [
        'show_newsletter' => 'boolean'
    ];

    public static function getSettings()
    {
        return self::first() ?? new self();
    }
}