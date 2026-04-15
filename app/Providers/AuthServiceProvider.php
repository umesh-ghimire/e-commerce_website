<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends \Illuminate\Foundation\Support\Providers\AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
        return $user->hasRole('admin') ? true : null;
    });
    }

 
}