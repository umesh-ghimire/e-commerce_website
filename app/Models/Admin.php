<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'permissions',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'permissions' => 'array',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    // Check if admin has specific role
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Check if admin has specific permission
    public function hasPermission(string $permission): bool
    {
        if ($this->role === 'super_admin') {
            return true;
        }
        
        return isset($this->permissions[$permission]) && $this->permissions[$permission] === true;
    }

    // Scope for active admins
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for specific role
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }
}