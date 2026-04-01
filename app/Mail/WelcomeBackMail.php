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

    public function __construct(User $user, $couponCode = null, $discount = 10)
    {
        $this->user = $user;
        $this->couponCode = $couponCode ?? 'WELCOME' . rand(1000, 9999);
        $this->discount = $discount;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Back! Here\'s a Special Gift for You 🎁',
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