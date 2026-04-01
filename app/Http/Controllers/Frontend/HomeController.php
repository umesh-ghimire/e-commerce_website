<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\DiscountBanner;
use App\Models\FooterLink;
use App\Models\FooterSetting;
use App\Models\Product;
use App\Models\Service;
use App\Models\SocialMediaLink;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products
        $featuredProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Get categories
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc')
            ->take(8)
            ->get();

        // Get best sellers
        $bestSellers = Product::where('is_active', true)
            ->where('is_best_seller', true)
            ->orderBy('rating', 'desc')
            ->take(8)
            ->get();

        // Get trending products
        $trendingProducts = Product::where('is_active', true)
            ->where('is_trending', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Get new arrivals
        $newArrivals = Product::where('is_active', true)
            ->where('is_new', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Get weekly popular
        $weeklyPopular = Product::where('is_active', true)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('rating', 'desc')
            ->take(8)
            ->get();

        // Get discounted products
        $discountedProducts = Product::where('is_active', true)
            ->where('discount', '>', 0)
            ->orderBy('discount', 'desc')
            ->take(4)
            ->get();

        // Get brands from database
        $dbBrands = Brand::active()
            ->ordered()
            ->take(8)
            ->get();

        // Get discount banners
        $discountBanners = DiscountBanner::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get services
        $services = Service::active()
            ->ordered()
            ->take(3)
            ->get();

        // Get footer settings
        $footerSettings = FooterSetting::getSettings();

        // Get footer links grouped by section
        $footerLinks = FooterLink::active()
            ->orderBy('order')
            ->get()
            ->groupBy('section');

        // Get social media links
        $socialLinks = SocialMediaLink::active()
            ->ordered()
            ->get();

        return view('frontend.home', compact(
            'featuredProducts',
            'categories',
            'bestSellers',
            'trendingProducts',
            'newArrivals',
            'weeklyPopular',
            'discountedProducts',
            'dbBrands',
            'discountBanners',
            'services',
            'footerSettings',
            'footerLinks',
            'socialLinks'
        ));
    }
}