<?php
// app/Listeners/SendWelcomeEmail.php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;
        
        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
            Log::info('Welcome email sent to: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Welcome email failed for ' . $user->email . ': ' . $e->getMessage());
        }
    }
}