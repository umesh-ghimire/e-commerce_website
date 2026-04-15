<?php
// app/Http/Controllers/CustomerProfileController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CustomerProfileController extends Controller
{
    /**
     * Display customer dashboard
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Calculate stats
        $stats = [
            'total_orders' => $user->orders()->count(),
            'total_spent' => $user->orders()->where('status', 'delivered')->sum('total'),
            'wishlist_count' => $user->wishlist()->count(),
            'reviews_count' => $user->reviews()->count(),
            'pending_orders' => $user->orders()->where('status', 'pending')->count(),
            'delivered_orders' => $user->orders()->where('status', 'delivered')->count(),
        ];
        
        $recent_orders = $user->orders()->latest()->take(5)->get();
        $recent_reviews = $user->reviews()->latest()->with('product')->take(3)->get();
        
        return view('profile.dashboard', compact('user', 'stats', 'recent_orders', 'recent_reviews'));
    }

    /**
     * Show profile edit form
     */
    public function editProfile()
    {
        $user = auth()->user();
        $addresses = $user->addresses()->latest()->get();
        return view('profile.edit', compact('user', 'addresses'));
    }

    /**
     * Update profile information
     */
   public function updateProfile(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:users,email,' . $user->id,
        'phone'  => 'nullable|string|max:20',     // Allow phone
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle avatar upload
    if ($request->hasFile('avatar')) {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $path = $request->file('avatar')->store('avatars', 'public');
        $validated['avatar'] = $path;
    }

    // Update user (this will now save the phone number)
    $user->update($validated);

    return redirect()->route('profile.edit')
        ->with('success', 'Profile updated successfully!');
}

    /**
     * Change password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);
        
        return back()->with('password_success', 'Password changed successfully!');
    }

    /**
     * Show orders list
     */
    public function orders(Request $request)
    {
        $user = auth()->user();
        $query = $user->orders()->with('items.product');
        
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        $orders = $query->latest()->paginate(10);
        
        return view('profile.orders', compact('orders'));
    }

    /**
     * Show single order details
     */
    public function orderDetails($orderId)
    {
        $order = auth()->user()->orders()->with('items.product')->findOrFail($orderId);
        return view('profile.order-details', compact('order'));
    }

    /**
     * Cancel order
     */
    public function cancelOrder($orderId)
    {
        $order = auth()->user()->orders()->findOrFail($orderId);
        
        if (in_array($order->status, ['pending', 'processing'])) {
            $order->update(['status' => 'cancelled']);
            return back()->with('success', 'Order cancelled successfully!');
        }
        
        return back()->with('error', 'This order cannot be cancelled.');
    }

    /**
     * Show wishlist
     */
    public function wishlist()
    {
        $wishlist = auth()->user()->wishlist()->with('product')->latest()->paginate(12);
        return view('profile.wishlist', compact('wishlist'));
    }

    /**
     * Add to wishlist
     */
    public function addToWishlist(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        
        $exists = auth()->user()->wishlist()->where('product_id', $request->product_id)->exists();
        
        if (!$exists) {
            auth()->user()->wishlist()->create(['product_id' => $request->product_id]);
            return response()->json(['success' => true, 'message' => 'Added to wishlist']);
        }
        
        return response()->json(['success' => false, 'message' => 'Already in wishlist']);
    }

    /**
     * Remove from wishlist
     */
    public function removeFromWishlist($id)
    {
        auth()->user()->wishlist()->findOrFail($id)->delete();
        return back()->with('success', 'Removed from wishlist');
    }

    /**
     * Show reviews
     */
    public function reviews()
    {
        $reviews = auth()->user()->reviews()->with('product')->latest()->paginate(10);
        return view('profile.reviews', compact('reviews'));
    }

    /**
     * Delete review
     */
    public function deleteReview($id)
    {
        auth()->user()->reviews()->findOrFail($id)->delete();
        return back()->with('success', 'Review deleted successfully!');
    }

    /**
     * Show addresses
     */
    public function addresses()
    {
        $addresses = auth()->user()->addresses()->latest()->get();
        return view('profile.addresses', compact('addresses'));
    }

    /**
     * Add new address
     */
    public function addAddress(Request $request)
    {
        $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'boolean',
        ]);
        
        if ($request->is_default) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }
        
        auth()->user()->addresses()->create($request->all());
        
        return back()->with('success', 'Address added successfully!');
    }

    /**
     * Update address
     */
    public function updateAddress(Request $request, $id)
    {
        $address = auth()->user()->addresses()->findOrFail($id);
        
        $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'boolean',
        ]);
        
        if ($request->is_default && !$address->is_default) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }
        
        $address->update($request->all());
        
        return back()->with('success', 'Address updated successfully!');
    }

    /**
     * Delete address
     */
    public function deleteAddress($id)
    {
        auth()->user()->addresses()->findOrFail($id)->delete();
        return back()->with('success', 'Address deleted successfully!');
    }

    /**
     * Set default address
     */
    public function setDefaultAddress($id)
    {
        auth()->user()->addresses()->update(['is_default' => false]);
        auth()->user()->addresses()->findOrFail($id)->update(['is_default' => true]);
        
        return back()->with('success', 'Default address updated!');
    }

    /**
     * Show notifications
     */
    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        return view('profile.notifications', compact('notifications'));
    }

    /**
     * Mark notification as read
     */
    public function markNotificationRead($id)
    {
        auth()->user()->notifications()->findOrFail($id)->update(['is_read' => true]);
        return back();
    }

    /**
     * Mark all notifications as read
     */
    public function markAllNotificationsRead()
    {
        auth()->user()->notifications()->update(['is_read' => true]);
        return back()->with('success', 'All notifications marked as read!');
    }

    /**
     * Show account settings
     */
    public function settings()
    {
        $user = auth()->user();
        return view('profile.settings', compact('user'));
    }

    /**
     * Update notification preferences
     */
    public function updatePreferences(Request $request)
    {
        $preferences = $request->only(['email_newsletter', 'email_offers', 'email_order_updates', 'sms_notifications']);
        
        auth()->user()->update([
            'preferences' => $preferences
        ]);
        
        return back()->with('success', 'Preferences updated!');
    }

    /**
     * Delete account request
     */
    public function deleteAccountRequest(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|min:10',
            'password' => 'required|current_password',
        ]);
        
        $user = auth()->user();
        
        auth()->logout();
        $user->delete();
        
        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}