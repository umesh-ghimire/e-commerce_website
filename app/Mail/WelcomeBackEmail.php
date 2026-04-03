<?php
// app/Mail/WelcomeBackEmail.php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeBackEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $stats;
    public $coupon;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $stats = [], $coupon = null)
    {
        $this->user = $user;
        $this->stats = $stats;
        $this->coupon = $coupon ?? 'WELCOMEBACK25';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Back! Exclusive Offers Await You at ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-back',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}