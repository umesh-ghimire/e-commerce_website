<?php
// app/Helpers/ImageHelper.php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get product image URL
     */
    public static function getProductImage($product)
    {
        // Handle array or object
        $image = is_array($product) ? ($product['image'] ?? null) : ($product->image ?? null);
        
        if (!$image) {
            return asset('images/placeholder.jpg');
        }
        
        // Check if image exists in storage (admin uploads)
        if (Storage::disk('public')->exists('products/' . $image)) {
            return Storage::url('products/' . $image);
        }
        
        // Fallback to old paths for backward compatibility
        $paths = [
            'images/home_images/' . $image,
            'images/products/' . $image,
            'products/' . $image,
        ];
        
        foreach ($paths as $path) {
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }
        
        return asset('images/placeholder.jpg');
    }
    
    /**
     * Get category image URL
     */
    public static function getCategoryImage($category)
    {
        if (!$category || !$category->image) {
            return null;
        }
        
        // Check if image exists in storage (admin uploads)
        if (Storage::disk('public')->exists('categories/' . $category->image)) {
            return Storage::url('categories/' . $category->image);
        }
        
        // Fallback to public path
        $publicPath = 'images/categories/' . $category->image;
        if (file_exists(public_path($publicPath))) {
            return asset($publicPath);
        }
        
        return null;
    }
    
    /**
     * Get brand logo URL
     */
    public static function getBrandLogo($brand)
    {
        if (!$brand || !$brand->logo) {
            return null;
        }
        
        // Check if logo exists in storage (admin uploads)
        if (Storage::disk('public')->exists('brands/' . $brand->logo)) {
            return Storage::url('brands/' . $brand->logo);
        }
        
        // Fallback to public path
        $publicPath = 'images/brands/' . $brand->logo;
        if (file_exists(public_path($publicPath))) {
            return asset($publicPath);
        }
        
        return null;
    }
}