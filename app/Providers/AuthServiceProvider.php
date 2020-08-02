<?php

namespace App\Providers;

use App\Client;
use Illuminate\Support\Facades\Auth;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $client = Auth::user();
        Gate::define('view_agents', function ($client) {
            if ($client->parent_id == 0)
                return true;
        });
        Gate::define('view_channels', function ($client) {
            if ($client->parent_id == 0)
                return true;
        });
        $this->registerPolicies();

        //
    }
}
