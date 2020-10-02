<?php

namespace App\Http\Controllers\Backend\adminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ManagerAdmin;


class RegisterAdController extends Controller
{
    public function showRegisterAdmin()
    {
        return view('admin.authAdmin.register');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'admin_name' => 'required|max:40',
            'email' => 'required|unique:manager_admins|max:100',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password'
        ]);
        // messenger đã được chuyển sang tiếng việt ở một số  validator trong file validation.
        // $validateData là một mảng chứa các field được gửi lên từ $request

        $admin = new ManagerAdmin;

        $admin->adminName = $request->admin_name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        if ($admin->save()) {
            $mess_success = 'Chúc mừng bạn đã đăng kí thành công';

            return back()->with('mess_success', $mess_success);
        }
    }
}