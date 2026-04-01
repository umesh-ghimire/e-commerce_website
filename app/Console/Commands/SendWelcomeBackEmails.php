<?php

namespace App\Console\Commands;

use App\Mail\WelcomeBackMail;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWelcomeBackEmails extends Command
{
    protected $signature = 'email:send-welcome-back';
    protected $description = 'Send welcome back emails to customers who purchased 7 days ago';

    public function handle()
    {
        $orders = Order::where('created_at', '>=', now()->subDays(8))
            ->where('created_at', '<', now()->subDays(7))
            ->where('status', 'delivered')
            ->get();

        foreach ($orders as $order) {
            if ($order->user && $order->user->email) {
                Mail::to($order->user->email)->send(new WelcomeBackMail($order->user));
                $this->info("Welcome back email sent to: {$order->user->email}");
            }
        }

        $this->info("Sent " . $orders->count() . " welcome back emails");
        return Command::SUCCESS;
    }
}