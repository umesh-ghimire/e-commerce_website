<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeBackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $couponCode;
    public $discount;

    public function __construct(User $user, $couponCode = null)
    {
        $this->user = $user;
        $this->couponCode = $couponCode ?? 'WELCOME' . rand(1000, 9999);
        
        // Calculate discount based on inactivity period
        $daysInactive = $user->last_login_at ? now()->diffInDays($user->last_login_at) : 30;
        
        if ($daysInactive > 60) {
            $this->discount = 25; // 25% off for very inactive users
        } elseif ($daysInactive > 30) {
            $this->discount = 15; // 15% off for inactive users
        } else {
            $this->discount = 10; // 10% off for new users
        }
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->discount >= 20 ? '🎁 Special Offer: ' . $this->discount . '% OFF Just for You!' : 'Welcome Back! Here\'s a Special Gift for You 🎁',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-back',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}