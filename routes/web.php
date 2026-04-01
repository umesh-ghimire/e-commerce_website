<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\FacebookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController; // ← Fixed namespace
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('frontend.category.index');
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('frontend.category.show');
});

// Product Routes - Correct namespace for ProductController
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('frontend.products.index');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('frontend.products.show');
    Route::get('/search', [ProductController::class, 'search'])->name('frontend.products.search');
});

// Search routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/quick-search', [SearchController::class, 'quickSearch'])->name('quick.search');

// Newsletter Routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Review Routes
Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/products/{product}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('frontend.cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('frontend.cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])
     ->name('frontend.checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])
     ->name('frontend.checkout.store');

Route::get('/order/success/{order}', [CheckoutController::class, 'success'])
     ->name('frontend.order.success'); 
     
Route::get('/payment/qr/{order}/{wallet}', [App\Http\Controllers\Frontend\CheckoutController::class, 'showQr'])
     ->name('frontend.payment.qr');     

Route::post('/payment/proof/{order}', [App\Http\Controllers\Frontend\CheckoutController::class, 'storePaymentProof'])
     ->name('frontend.payment.proof.store');     

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Login With Google Routes
Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/login/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Facebook login routes
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

require __DIR__.'/auth.php';