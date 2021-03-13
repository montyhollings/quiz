<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->super_admin) {
                return true;
            }
        });
        Gate::define('administrator', function (User $user, Post $post) {
            return $user->role === 1;
        });
        Gate::define('user', function (User $user, Post $post) {
            return $user->role === 2;
        });
        Gate::define('restricted_user', function (User $user, Post $post) {
            return $user->role === 3;
        });

        //
    }
}
