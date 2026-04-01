<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;  // Add this import at the top


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');




// Send welcome back emails daily
Schedule::command('email:send-welcome-back')->daily();

// Or you can set specific time
Schedule::command('email:send-welcome-back')->dailyAt('09:00');

// You can also chain additional methods
Schedule::command('email:send-welcome-back')
    ->daily()
    ->withoutOverlapping()
    ->runInBackground();