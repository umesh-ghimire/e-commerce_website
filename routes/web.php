<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\FacebookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CustomerProfileController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('frontend.category.index');
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('frontend.category.show');
});

// Product Routes
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
Route::get('/checkout', [CheckoutController::class, 'index'])->name('frontend.checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('frontend.checkout.store');
Route::get('/order/success/{order}', [CheckoutController::class, 'success'])->name('frontend.order.success');
Route::get('/payment/qr/{order}/{wallet}', [App\Http\Controllers\Frontend\CheckoutController::class, 'showQr'])->name('frontend.payment.qr');
Route::post('/payment/proof/{order}', [App\Http\Controllers\Frontend\CheckoutController::class, 'storePaymentProof'])->name('frontend.payment.proof.store');

// Login With Google Routes
Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/login/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Facebook login routes
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// Customer Profile Routes
Route::prefix('profile')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [CustomerProfileController::class, 'dashboard'])->name('profile.dashboard');
    Route::get('/dashboard', [CustomerProfileController::class, 'dashboard'])->name('profile.dashboard.alt');
    
    // Profile Management
    Route::get('/edit', [CustomerProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/update', [CustomerProfileController::class, 'updateProfile'])->name('profile.update');   // POST (matches your form)
    Route::patch('/password', [CustomerProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Orders
    Route::get('/orders', [CustomerProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/orders/{id}', [CustomerProfileController::class, 'orderDetails'])->name('profile.order.details');
    Route::post('/orders/{id}/cancel', [CustomerProfileController::class, 'cancelOrder'])->name('profile.order.cancel');
    
    // Wishlist
    Route::get('/wishlist', [CustomerProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::post('/wishlist/add', [CustomerProfileController::class, 'addToWishlist'])->name('profile.wishlist.add');
    Route::delete('/wishlist/{id}', [CustomerProfileController::class, 'removeFromWishlist'])->name('profile.wishlist.remove');
    
    // Reviews
    Route::get('/reviews', [CustomerProfileController::class, 'reviews'])->name('profile.reviews');
    Route::delete('/reviews/{id}', [CustomerProfileController::class, 'deleteReview'])->name('profile.review.delete');
    
    // Addresses
    Route::get('/addresses', [CustomerProfileController::class, 'addresses'])->name('profile.addresses');
    Route::post('/addresses', [CustomerProfileController::class, 'addAddress'])->name('profile.address.store');
    Route::put('/addresses/{id}', [CustomerProfileController::class, 'updateAddress'])->name('profile.address.update');
    Route::delete('/addresses/{id}', [CustomerProfileController::class, 'deleteAddress'])->name('profile.address.delete');
    Route::post('/addresses/{id}/default', [CustomerProfileController::class, 'setDefaultAddress'])->name('profile.address.default');
    
    // Notifications
    Route::get('/notifications', [CustomerProfileController::class, 'notifications'])->name('profile.notifications');
    Route::post('/notifications/{id}/read', [CustomerProfileController::class, 'markNotificationRead'])->name('profile.notification.read');
    Route::post('/notifications/read-all', [CustomerProfileController::class, 'markAllNotificationsRead'])->name('profile.notifications.read-all');
    
    // Settings
    Route::get('/settings', [CustomerProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/preferences', [CustomerProfileController::class, 'updatePreferences'])->name('profile.preferences');
    Route::delete('/account', [CustomerProfileController::class, 'deleteAccountRequest'])->name('profile.delete');
});

// Dashboard alias (for navigation compatibility)
Route::middleware(['auth'])->get('/dashboard', [CustomerProfileController::class, 'dashboard'])->name('dashboard');

require __DIR__.'/auth.php';