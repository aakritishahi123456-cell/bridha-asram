<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Define gates for role-based access control
        Gate::define('access-admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isSuperAdmin();
        });

        Gate::define('manage-donations', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-volunteers', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-content', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-impact-metrics', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('volunteer-access', function (User $user) {
            return $user->isVolunteer() && 
                   $user->volunteer && 
                   $user->volunteer->status === 'approved';
        });
    }
}