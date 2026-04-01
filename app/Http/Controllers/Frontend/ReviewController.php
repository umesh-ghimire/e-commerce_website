<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'required|string',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }

        // Check if user purchased this product
        $hasPurchased = Auth::user()->orders()
            ->whereHas('items', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })
            ->where('status', 'delivered')
            ->exists();

        // Handle images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $imagePaths[] = $path;
            }
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'images' => $imagePaths,
            'is_verified_purchase' => $hasPurchased,
            'is_approved' => false, 
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!.');
    }

    public function index(Request $request, Product $product)
    {
        $reviews = $product->approvedReviews()
            ->with('user')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $ratingSummary = [
            'average' => $product->averageRating,
            'total' => $product->totalReviews,
            'distribution' => [
                5 => $product->reviews()->where('rating', 5)->count(),
                4 => $product->reviews()->where('rating', 4)->count(),
                3 => $product->reviews()->where('rating', 3)->count(),
                2 => $product->reviews()->where('rating', 2)->count(),
                1 => $product->reviews()->where('rating', 1)->count(),
            ]
        ];

        return view('frontend.reviews.index', compact('product', 'reviews', 'ratingSummary'));
    }
}