<?php
// app/Listeners/UpdateLastLogin.php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class UpdateLastLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        
        try {
            $user->update(['last_login_at' => now()]);
            
            // Call welcome-back email check
            $user->sendWelcomeBackEmail();
            
            Log::info('Last login updated for: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Failed to update last login for ' . $user->email . ': ' . $e->getMessage());
        }
    }
}