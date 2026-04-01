<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\DiscountBanner;
use App\Models\FooterLink;
use App\Models\FooterSetting;
use App\Models\Service;
use App\Models\SocialMediaLink;
use Illuminate\Database\Seeder;

class DefaultSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Create default footer settings
        FooterSetting::create([
            'company_name' => 'PrimeHub',
            'company_description' => 'Your one-stop shop for amazing products at unbeatable prices.',
            'email' => 'info@primehub.com',
            'phone' => '+977 9800000000',
            'address' => 'Kathmandu, Nepal',
            'copyright_text' => '© 2024 PrimeHub. All rights reserved.',
            'newsletter_title' => 'Subscribe to our newsletter',
            'newsletter_description' => 'Get the latest updates on new products and upcoming sales',
            'show_newsletter' => true,
            'primary_color' => '#166534',
            'secondary_color' => '#1f2937'
        ]);

        // Create default footer links
        $footerLinks = [
            ['title' => 'About Us', 'section' => 'quick_links', 'url' => '/about', 'order' => 1],
            ['title' => 'Contact Us', 'section' => 'quick_links', 'url' => '/contact', 'order' => 2],
            ['title' => 'Blog', 'section' => 'quick_links', 'url' => '/blog', 'order' => 3],
            ['title' => 'FAQ', 'section' => 'help', 'url' => '/faq', 'order' => 1],
            ['title' => 'Shipping Info', 'section' => 'help', 'url' => '/shipping', 'order' => 2],
            ['title' => 'Returns', 'section' => 'help', 'url' => '/returns', 'order' => 3],
            ['title' => 'My Account', 'section' => 'account', 'url' => '/profile', 'order' => 1],
            ['title' => 'Order History', 'section' => 'account', 'url' => '/orders', 'order' => 2],
            ['title' => 'Wishlist', 'section' => 'account', 'url' => '/wishlist', 'order' => 3],
        ];

        foreach ($footerLinks as $link) {
            FooterLink::create($link);
        }

        // Create default services
        $services = [
            [
                'title' => 'Frequently asked questions',
                'description' => 'Get answers to all your shopping questions',
                'icon_class' => 'fas fa-question-circle',
                'background_color' => '#eff6ff',
                'text_color' => '#1e40af',
                'button_text' => 'Learn More',
                'button_link' => '/faq',
                'order' => 1
            ],
            [
                'title' => 'Online Payment Process',
                'description' => 'Secure and easy payment options',
                'icon_class' => 'fas fa-credit-card',
                'background_color' => '#f0fdf4',
                'text_color' => '#166534',
                'button_text' => 'Learn More',
                'button_link' => '/payment',
                'order' => 2
            ],
            [
                'title' => 'Home Delivery Options',
                'description' => 'Fast and reliable delivery services',
                'icon_class' => 'fas fa-truck',
                'background_color' => '#faf5ff',
                'text_color' => '#6b21a5',
                'button_text' => 'Learn More',
                'button_link' => '/delivery',
                'order' => 3
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Create default discount banner
        DiscountBanner::create([
            'title' => 'Get 5% Cash back on ₹200',
            'description' => 'Shopping is a bit of a relaxing hobby for me, which is sometimes troubling for the bank balance.',
            'background_color' => '#1f2937',
            'text_color' => '#ffffff',
            'discount_percentage' => 70,
            'button_text' => 'Shop Now',
            'button_link' => '/products',
            'cashback_text' => 'Get 5% Cash back',
            'cashback_amount' => 10,
            'minimum_purchase' => 200,
            'is_active' => true,
            'order' => 1
        ]);

        // Create default social media links
        $socialLinks = [
            ['platform' => 'Facebook', 'url' => 'https://facebook.com', 'icon_class' => 'fab fa-facebook-f', 'color' => '#1877f2', 'order' => 1],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com', 'icon_class' => 'fab fa-instagram', 'color' => '#e4405f', 'order' => 2],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com', 'icon_class' => 'fab fa-twitter', 'color' => '#1da1f2', 'order' => 3],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com', 'icon_class' => 'fab fa-youtube', 'color' => '#ff0000', 'order' => 4],
        ];

        foreach ($socialLinks as $link) {
            SocialMediaLink::create($link);
        }
    }
}