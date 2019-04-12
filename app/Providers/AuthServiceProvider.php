<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('access', function ($user, $resource, $privilege) {
            if($user->isSuperAdmin()){
                return TRUE;
            }
            
            foreach ($user->role->accessControl as $accessControl) {
                if($accessControl->resource == $resource && $accessControl->privilege == $privilege){
                    return TRUE;
                }
            }
            return FALSE;
        });
    }
}
