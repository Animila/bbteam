<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
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

        Gate::before(function (?User $user) {
                if ($user && $user->role == 'admin') {
                    return true;
                }
            }
        );
        Gate::define('for_admin_user', function (?User $user) {
            return $user && $user->role == 'admin';
        });
        //проверка на премиум доступ
        Gate::define('for_premium_user', function (?User $user) {
            return $user && $user->premium;
        });
    }
}
