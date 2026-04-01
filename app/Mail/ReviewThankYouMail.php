<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReviewThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $product;
    public $review;

    public function __construct(User $user, Product $product, Review $review)
    {
        $this->user = $user;
        $this->product = $product;
        $this->review = $review;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You for Your Review!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.review-thankyou',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}