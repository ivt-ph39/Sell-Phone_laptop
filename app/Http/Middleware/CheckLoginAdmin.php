<?php

namespace App\Http\Middleware;

use App\Model\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $roles = User::find(Auth::user()->id)->roles()->get();
            foreach ($roles as $role) {
                $permissionUser = $role->permissions()->get();
                if ($permissionUser->contains('keycode', 'login_admin')) {
                    return $next($request);
                }
            }
        }
        return redirect('admin/login');
    }
}
