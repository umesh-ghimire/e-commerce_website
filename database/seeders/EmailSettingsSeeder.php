<?php
// database/seeders/EmailSettingsSeeder.php

namespace Database\Seeders;

use App\Models\EmailSetting;
use Illuminate\Database\Seeder;

class EmailSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'welcome_email_subject',
                'value' => 'Welcome to :app_name!',
                'type' => 'text',
                'description' => 'Subject line for welcome emails',
            ],
            [
                'key' => 'welcome_back_subject',
                'value' => 'Welcome Back! Exclusive Offers Await',
                'type' => 'text',
                'description' => 'Subject line for welcome-back emails',
            ],
            [
                'key' => 'welcome_discount',
                'value' => '20',
                'type' => 'number',
                'description' => 'Discount percentage for new users',
            ],
            [
                'key' => 'welcome_back_discount',
                'value' => '25',
                'type' => 'number',
                'description' => 'Discount percentage for returning users',
            ],
            [
                'key' => 'inactivity_days',
                'value' => '30',
                'type' => 'number',
                'description' => 'Days after which to send welcome-back email',
            ],
            [
                'key' => 'enable_welcome_email',
                'value' => '1',
                'type' => 'text',
                'description' => 'Enable/disable welcome emails',
            ],
            [
                'key' => 'enable_welcome_back',
                'value' => '1',
                'type' => 'text',
                'description' => 'Enable/disable welcome-back emails',
            ],
        ];

        foreach ($settings as $setting) {
            EmailSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}