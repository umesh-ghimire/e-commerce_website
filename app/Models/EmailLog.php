<?php
// app/Models/EmailLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'subject',
        'type',
        'status',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Log email sent
    public static function log($email, $subject, $type, $userId = null, $status = 'sent')
    {
        return self::create([
            'user_id' => $userId,
            'email' => $email,
            'subject' => $subject,
            'type' => $type,
            'status' => $status,
            'sent_at' => now(),
        ]);
    }
}