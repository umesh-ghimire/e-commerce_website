<?php

namespace App\Console\Commands;

use App\Mail\WelcomeBackMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendInactiveUsersWelcomeBack extends Command
{
    protected $signature = 'email:inactive-welcome-back {--days=30 : Days since last login}';
    protected $description = 'Send welcome back emails to inactive users';

    public function handle()
    {
        $days = $this->option('days');
        
        $users = User::where('last_login_at', '<=', now()->subDays($days))
            ->orWhereNull('last_login_at')
            ->where('created_at', '<=', now()->subDays($days))
            ->get();

        $count = 0;
        
        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new WelcomeBackMail($user));
                $count++;
                $this->info("Welcome back email sent to: {$user->email}");
            } catch (\Exception $e) {
                $this->error("Failed to send email to {$user->email}: " . $e->getMessage());
            }
        }

        $this->info("Sent {$count} welcome back emails to inactive users");
        return Command::SUCCESS;
    }
}