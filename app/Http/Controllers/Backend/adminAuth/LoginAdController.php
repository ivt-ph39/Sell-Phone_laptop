<?php

namespace App\Http\Controllers\Backend\adminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginAdController extends Controller
{
    public function showLoginAdmin()
    {
        return view('admin.authAdmin.login');
    }
    function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('manager_admin')->attempt($credentials)) {
            return redirect('admin/home');
        } else {
            $login_false = 'Email hoặc Password không chính xác';
            return redirect('admin/login')->with('login_false', $login_false);
        }
    }
    public function logout()
    {
        Auth::guard('manager_admin')->logout();
        return redirect('admin/login');
    }
}