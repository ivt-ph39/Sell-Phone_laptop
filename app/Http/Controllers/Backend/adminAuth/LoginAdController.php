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
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect('admin/home');
        } else {
            $login_false = 'Email hoặc Password không chính xác';
            return redirect('admin/login')->with('login_false', $login_false);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}