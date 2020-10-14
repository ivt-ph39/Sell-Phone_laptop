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
        //callback
    }

    // create function define gate model 
    public function gateDefineUser(){
        Gate::define('user_list', function($user){ return $user->checkPermissionAccess('user_list'); });
       
    }

    public function gateDefineRole(){
        // code here
    }

    // function ...
}
