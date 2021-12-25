<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerUserPolicies();
        //
    }

    // ================= define policie for user permissions =============== //
    public function registerUserPolicies()
    {

        Gate::define('update-user',function(User $user)
        {
          return $user->hasAccess(['update-user']);
        });

        Gate::define('edit-user',function($user)
        {
           return $user->hasAccess(['edit-user']);
        });

        Gate::define('delete-user',function($user)
        {
           return $user->hasAccess(['delete-user']);
        });

        Gate::define('force-logout',function($user)
        {
           return $user->hasAccess(['force-logout']);
        });
    }

    // ======================================================================== //
}
