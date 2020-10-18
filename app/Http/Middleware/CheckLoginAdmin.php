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
        if (!Auth::check()) {
            return redirect('admin/login')->with('login_false', 'Bạn không có quyền truy cập trang này')->withInput();
        } else {
            $roles = User::find(Auth::user()->id)->roles()->get();
            if ($roles == null) {
                return redirect('admin/login')->with('login_false', 'Bạn không có quyền truy cập trang này')->withInput();
            } else {
                $checkRole = false;
                if ($roles->count() == 1) {
                    foreach ($roles as $role) {
                        if ($role->name == 'guest') {
                            return redirect('admin/login')->with('login_false', 'Bạn không có quyền truy cập trang này')->withInput();
                        } else {
                            return $next($request);
                        }
                    }
                }
            }
        }
        return $next($request);
    }
}