<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Main search page
     */
    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->get('query', $request->get('q', ''));
        
        // Search for products
        $products = Product::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('brand', 'LIKE', "%{$query}%");
            })
            ->paginate(12);
        
        // Return the view with products and query
        return view('search.results', compact('products', 'query'));
    }

    /**
     * Quick search for AJAX/navbar search
     */
    public function quickSearch(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $products = Product::where('is_active', true)
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'name', 'slug', 'price', 'image']);
        
        return response()->json($products);
    }
}