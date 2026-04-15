<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Address;
use App\Models\Wishlist;
use App\Models\Notification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'google_id',
        'facebook_id',
        'avatar',
        'email_verified_at',
        'last_login_at',
        'last_activity_at',
        'last_welcome_back_sent_at',
        'points',
        'preferences', 
        'deletion_requested_at', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'last_activity_at' => 'datetime',
            'last_welcome_back_sent_at' => 'datetime',
            'password' => 'hashed',
            'points' => 'integer',
            'preferences' => 'array',
            'deletion_requested_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function booted()
    {
        // Send welcome email for new users (including social login)
        static::created(function ($user) {
            try {
                // Create email instance
                $welcomeEmail = new \App\Mail\WelcomeEmail($user);
                Mail::to($user->email)->send($welcomeEmail);
                Log::info('Welcome email sent to: ' . $user->email);
            } catch (\Exception $e) {
                Log::error('Welcome email failed for ' . $user->email . ': ' . $e->getMessage());
            }
        });
    }

    /**
     * Update last login timestamp and send welcome-back email if needed.
     */
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
        $this->sendWelcomeBackEmail();
    }

    /**
     * Send welcome-back email for returning users.
     */
    public function sendWelcomeBackEmail()
    {
        // Calculate days since last login
        $daysSinceLastLogin = $this->last_login_at 
            ? now()->diffInDays($this->last_login_at) 
            : 30;
        
        // Check if welcome-back email wasn't sent in last 7 days
        $canSend = !$this->last_welcome_back_sent_at || 
                   now()->diffInDays($this->last_welcome_back_sent_at) >= 7;
        
        // Send email if user hasn't logged in for 30+ days
        if ($daysSinceLastLogin >= 30 && $canSend) {
            try {
                $stats = [
                    'points' => $this->getRewardPoints(),
                    'offers' => $this->getAvailableOffers(),
                    'products' => \App\Models\Product::where('created_at', '>=', now()->subDays(30))->count(),
                ];
                
                $coupon = $this->generateWelcomeBackCoupon();
                
                $welcomeBackEmail = new \App\Mail\WelcomeBackEmail($this, $stats, $coupon);
                Mail::to($this->email)->send($welcomeBackEmail);
                
                $this->update(['last_welcome_back_sent_at' => now()]);
                
                Log::info('Welcome-back email sent to: ' . $this->email);
            } catch (\Exception $e) {
                Log::error('Welcome-back email failed for ' . $this->email . ': ' . $e->getMessage());
            }
        }
    }

    /**
     * Get user's reward points.
     */
    public function getRewardPoints()
    {
        return $this->points ?? 0;
    }

    protected static function booted()
{
    static::created(function ($user) {
        $user->assignRole('user');
    });
}
    /**
     * Add reward points to user.
     */
    public function addRewardPoints($points)
    {
        $this->increment('points', $points);
    }

    /**
     * Get available offers count.
     */
    public function getAvailableOffers()
    {
        try {
            return \App\Models\Offer::where('expires_at', '>', now())
                        ->where('is_active', true)
                        ->count() ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Generate welcome-back coupon code.
     */
    public function generateWelcomeBackCoupon()
    {
        $code = 'WB' . strtoupper(substr($this->name, 0, 3)) . rand(100, 999);
        
        try {
            // Store coupon in database if Offer model exists
            if (class_exists(\App\Models\Offer::class)) {
                \App\Models\Offer::create([
                    'user_id' => $this->id,
                    'code' => $code,
                    'discount' => 25,
                    'type' => 'percentage',
                    'expires_at' => now()->addDays(7),
                    'is_active' => true,
                ]);
            }
        } catch (\Exception $e) {
            Log::warning('Could not save coupon to database: ' . $e->getMessage());
        }
        
        return $code;
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    /**
     * Get the reviews for the user.
     */
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    /**
     * Get the cart items for the user.
     */
    public function cart()
    {
        return $this->hasMany(\App\Models\Cart::class);
    }

    /**
     * Get the user's offers.
     */
    public function offers()
    {
        return $this->hasMany(\App\Models\Offer::class);
    }

    /**
     * Get the addresses for the user.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the wishlist items for the user.
     */
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get the notifications for the user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the user's default address.
     */
    public function getDefaultAddressAttribute()
    {
        return $this->addresses()->where('is_default', true)->first();
    }

    /**
     * Check if user logged in via Google.
     */
    public function isGoogleUser()
    {
        return !is_null($this->google_id);
    }

    /**
     * Check if user logged in via Facebook.
     */
    public function isFacebookUser()
    {
        return !is_null($this->facebook_id);
    }

    /**
     * Check if user is social login user.
     */
    public function isSocialUser()
    {
        return $this->isGoogleUser() || $this->isFacebookUser();
    }

    /**
     * Get user's total spent.
     */
    public function getTotalSpentAttribute()
    {
        try {
            return $this->orders()->where('status', 'delivered')->sum('total');
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get user's order count.
     */
    public function getOrderCountAttribute()
    {
        try {
            return $this->orders()->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get user's average order value.
     */
    public function getAverageOrderValueAttribute()
    {
        $orderCount = $this->order_count;
        return $orderCount > 0 ? $this->total_spent / $orderCount : 0;
    }

    /**
     * Send manual welcome email (for testing or resending).
     */
    public function sendWelcomeEmail()
    {
        try {
            $welcomeEmail = new \App\Mail\WelcomeEmail($this);
            Mail::to($this->email)->send($welcomeEmail);
            Log::info('Manual welcome email sent to: ' . $this->email);
            return true;
        } catch (\Exception $e) {
            Log::error('Manual welcome email failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send manual welcome-back email (for testing or resending).
     */
    public function sendManualWelcomeBackEmail()
    {
        try {
            $stats = [
                'points' => $this->getRewardPoints(),
                'offers' => $this->getAvailableOffers(),
                'products' => \App\Models\Product::where('created_at', '>=', now()->subDays(30))->count(),
            ];
            
            $coupon = $this->generateWelcomeBackCoupon();
            
            $welcomeBackEmail = new \App\Mail\WelcomeBackEmail($this, $stats, $coupon);
            Mail::to($this->email)->send($welcomeBackEmail);
            
            Log::info('Manual welcome-back email sent to: ' . $this->email);
            return true;
        } catch (\Exception $e) {
            Log::error('Manual welcome-back email failed: ' . $e->getMessage());
            return false;
        }
    }
}