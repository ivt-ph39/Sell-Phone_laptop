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
        $this->gateDefineUser(); // module User
        $this->gateDefineRole(); // module Role
        $this->gateDefinePermission(); // module Permission
        $this->gateDefineOrder(); // module Order
        $this->gateDefineComment(); // module Comment
        $this->gateDefineBlog(); // module Blog
        $this->gateDefineAdminManager(); // module admin manager
        // a hung
        $this->gateDefineCategory();
        $this->gateDefineProduct();
        $this->gateDefineContact();
        $this->gateDefineBrand();
        $this->gateDefineSlider();
    }

    // create function define gate model  Chức năng _ Table
    public function gateDefineUser(){
        Gate::define('list_user', function($user){ return $user->checkPermissionAccess('list_user'); });
        Gate::define('add_user', function($user){ return $user->checkPermissionAccess('add_user'); });
        Gate::define('edit_user', function($user){ return $user->checkPermissionAccess('edit_user'); });
        Gate::define('delete_user', function($user){ return $user->checkPermissionAccess('delete_user'); });
    }

    public function gateDefineRole(){
        Gate::define('list_role', function($user){ return $user->checkPermissionAccess('list_role'); });
        Gate::define('edit_role', function($user){ return $user->checkPermissionAccess('edit_role'); });
        Gate::define('add_role', function($user){ return $user->checkPermissionAccess('add_role'); });
        Gate::define('delete_role', function($user){ return $user->checkPermissionAccess('delete_role'); });
    }

    public function gateDefinePermission(){
        Gate::define('list_permission', function($user){ return $user->checkPermissionAccess('list_permission'); });
        Gate::define('edit_permission', function($user){ return $user->checkPermissionAccess('edit_permission'); });
        Gate::define('add_permission', function($user){ return $user->checkPermissionAccess('add_permission'); });
        Gate::define('delete_permission', function($user){ return $user->checkPermissionAccess('delete_permission'); });
    }

    public function gateDefineOrder(){
        Gate::define('list_order', function($user){ return $user->checkPermissionAccess('list_order'); });
        Gate::define('edit_order', function($user){ return $user->checkPermissionAccess('edit_order'); });
        Gate::define('add_order', function($user){ return $user->checkPermissionAccess('add_order'); });
        Gate::define('delete_order', function($user){ return $user->checkPermissionAccess('delete_order'); });
    }

    public function gateDefineComment(){
        Gate::define('list_comment', function($user){ return $user->checkPermissionAccess('list_comment'); });
        Gate::define('edit_comment', function($user){ return $user->checkPermissionAccess('edit_comment'); });
        Gate::define('reply_comment', function($user){ return $user->checkPermissionAccess('reply_comment'); });
        Gate::define('delete_comment', function($user){ return $user->checkPermissionAccess('delete_comment'); });
    }

    public function gateDefineBlog(){
        Gate::define('list_blog', function($user){ return $user->checkPermissionAccess('list_blog'); });
        Gate::define('edit_blog', function($user){ return $user->checkPermissionAccess('edit_blog'); });
        Gate::define('add_blog', function($user){ return $user->checkPermissionAccess('add_blog'); });
        Gate::define('delete_blog', function($user){ return $user->checkPermissionAccess('delete_blog'); });
    }

    public function gateDefineAdminManager(){
        Gate::define('admin_manager', function($user){ return $user->checkPermissionAccess('admin_manager'); });
    }
    // anh hung
    public function gateDefineCategory(){
        Gate::define('list_category', function($user){ return $user->checkPermissionAccess('list_category'); });
    }
    
    public function gateDefineProduct(){
        Gate::define('list_product', function($user){ return $user->checkPermissionAccess('list_product'); });
    }

    public function gateDefineBrand(){
        Gate::define('list_brand', function($user){ return $user->checkPermissionAccess('list_brand'); });
    }

    public function gateDefineContact(){
        Gate::define('list_contact', function($user){ return $user->checkPermissionAccess('list_contact'); });
    }

    public function gateDefineSlider(){
        Gate::define('list_slider', function($user){ return $user->checkPermissionAccess('list_slider'); });
    }



    

   


}
