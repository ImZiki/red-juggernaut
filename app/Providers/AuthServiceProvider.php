<?php
namespace App\Providers;

use App\Models\Order;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\OrderPolicy;
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
        User::class => AdminPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Ejemplo de política de acceso al panel de administración
        Gate::define('accessAdminPanel', function ($user) {
            return $user->role === 'admin';
        });
    }
}
