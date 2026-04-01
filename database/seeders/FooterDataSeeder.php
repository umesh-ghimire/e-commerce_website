<?php

namespace Database\Seeders;

use App\Models\FooterLink;
use App\Models\FooterSetting;
use App\Models\SocialMediaLink;
use Illuminate\Database\Seeder;

class FooterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create footer settings
        FooterSetting::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => 'PrimeHub',
                'company_description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
                'email' => 'info@primehub.com',
                'phone' => '+977 9800000000',
                'address' => 'Kathmandu, Nepal',
                'copyright_text' => 'All Rights Reserved by primehub PrimeHub Web | 2025',
                'newsletter_title' => 'Subscribe to our newsletter',
                'newsletter_description' => 'Get the latest updates on new products and upcoming sales',
                'show_newsletter' => true,
            ]
        );

        // Department links
        $departments = [
            ['title' => 'Fashion', 'url' => '/category/fashion', 'order' => 1],
            ['title' => 'Education Product', 'url' => '/category/education', 'order' => 2],
            ['title' => 'Frozen Food', 'url' => '/category/frozen-food', 'order' => 3],
            ['title' => 'Beverages', 'url' => '/category/beverages', 'order' => 4],
            ['title' => 'Organic Grocery', 'url' => '/category/organic', 'order' => 5],
            ['title' => 'Beauty Products', 'url' => '/category/beauty', 'order' => 6],
            ['title' => 'Books', 'url' => '/category/books', 'order' => 7],
            ['title' => 'Electronics & Gadget', 'url' => '/category/electronics', 'order' => 8],
            ['title' => 'Travel Accessories', 'url' => '/category/travel', 'order' => 9],
            ['title' => 'Fitness', 'url' => '/category/fitness', 'order' => 10],
            ['title' => 'Sneakers', 'url' => '/category/sneakers', 'order' => 11],
            ['title' => 'Toys', 'url' => '/category/toys', 'order' => 12],
            ['title' => 'Furniture', 'url' => '/category/furniture', 'order' => 13],
        ];

        foreach ($departments as $dept) {
            FooterLink::updateOrCreate(
                ['title' => $dept['title'], 'section' => 'department'],
                [
                    'url' => $dept['url'],
                    'section' => 'department',
                    'is_active' => true,
                    'order' => $dept['order']
                ]
            );
        }

        // About Us links
        $aboutLinks = [
            ['title' => 'About PrimeHub', 'url' => '/about', 'order' => 1],
            ['title' => 'Careers', 'url' => '/careers', 'order' => 2],
            ['title' => 'News & Blog', 'url' => '/blog', 'order' => 3],
            ['title' => 'Help', 'url' => '/help', 'order' => 4],
            ['title' => 'Press Center', 'url' => '/press', 'order' => 5],
            ['title' => 'Shop By Location', 'url' => '/locations', 'order' => 6],
            ['title' => 'Shopcart Brands', 'url' => '/brands', 'order' => 7],
            ['title' => 'Affiliate & Partners', 'url' => '/affiliate', 'order' => 8],
            ['title' => 'Ideas & Guides', 'url' => '/guides', 'order' => 9],
        ];

        foreach ($aboutLinks as $link) {
            FooterLink::updateOrCreate(
                ['title' => $link['title'], 'section' => 'about'],
                [
                    'url' => $link['url'],
                    'section' => 'about',
                    'is_active' => true,
                    'order' => $link['order']
                ]
            );
        }

        // Services links
        $servicesLinks = [
            ['title' => 'Gift Card', 'url' => '/gift-cards', 'order' => 1],
            ['title' => 'Web App', 'url' => '/web-app', 'order' => 2],
            ['title' => 'Shipping & Delivery', 'url' => '/shipping', 'order' => 3],
            ['title' => 'Account Signup', 'url' => '/register', 'order' => 4],
        ];

        foreach ($servicesLinks as $link) {
            FooterLink::updateOrCreate(
                ['title' => $link['title'], 'section' => 'services'],
                [
                    'url' => $link['url'],
                    'section' => 'services',
                    'is_active' => true,
                    'order' => $link['order']
                ]
            );
        }

        // Bottom links (Become Seller, Gift Cards, Help Center)
        $bottomLinks = [
            ['title' => 'Become Seller', 'url' => '/become-seller', 'icon' => '💼', 'order' => 1],
            ['title' => 'Gift Cards', 'url' => '/gift-cards', 'icon' => '🎁', 'order' => 2],
            ['title' => 'Help Center', 'url' => '/help', 'icon' => '❓', 'order' => 3],
        ];

        foreach ($bottomLinks as $link) {
            FooterLink::updateOrCreate(
                ['title' => $link['title'], 'section' => 'bottom_links'],
                [
                    'url' => $link['url'],
                    'section' => 'bottom_links',
                    'icon' => $link['icon'],
                    'is_active' => true,
                    'order' => $link['order']
                ]
            );
        }

        // Legal links
        $legalLinks = [
            ['title' => 'Terms of Service', 'url' => '/terms', 'order' => 1],
            ['title' => 'Privacy & Policy', 'url' => '/privacy', 'order' => 2],
        ];

        foreach ($legalLinks as $link) {
            FooterLink::updateOrCreate(
                ['title' => $link['title'], 'section' => 'legal'],
                [
                    'url' => $link['url'],
                    'section' => 'legal',
                    'is_active' => true,
                    'order' => $link['order']
                ]
            );
        }

        // Social Media Links
        $socialMedia = [
            ['platform' => 'Facebook', 'url' => 'https://facebook.com', 'icon_class' => 'fab fa-facebook-f', 'color' => '#1877f2', 'order' => 1],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com', 'icon_class' => 'fab fa-instagram', 'color' => '#e4405f', 'order' => 2],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com', 'icon_class' => 'fab fa-twitter', 'color' => '#1da1f2', 'order' => 3],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com', 'icon_class' => 'fab fa-youtube', 'color' => '#ff0000', 'order' => 4],
        ];

        foreach ($socialMedia as $social) {
            SocialMediaLink::updateOrCreate(
                ['platform' => $social['platform']],
                [
                    'url' => $social['url'],
                    'icon_class' => $social['icon_class'],
                    'color' => $social['color'],
                    'is_active' => true,
                    'order' => $social['order']
                ]
            );
        }
    }
}