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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->gateDefineUser();
        $this->gateDefineLogin();
        //callback
    }

    // create function define gate model 
    public function gateDefineUser(){
        Gate::define('list_user', function($user){ return $user->checkPermissionAccess('list_user'); });
        Gate::define('user_add', function($user){ return $user->checkPermissionAccess('user_add'); });
    }

    public function gateDefineRole(){
        // code here
    } 

    // function ...
    public function gateDefineLogin(){
        Gate::define('login_admin', function($user){ return $user->checkPermissionAccess('login_admin'); });
        Gate::define('login_user', function($user){ return $user->checkPermissionAccess('login_user'); });
    }
}
