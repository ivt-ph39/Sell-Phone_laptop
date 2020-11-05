<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Order;
use App\User;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request, User $user)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
            'address' => 'required',
            'phone' => 'required',
        ];
        $message = [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải nhiều hơn 8 kí tự',
            'password_confirm.required' => 'Mật khẩu nhập lại không được để trống',
            'password_confirm.same' => 'Mật khẩu không không trùng khớp',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống'
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'error'   => true,
                'message' => $validator->errors()
            ], 200);
        } else {
            $data = $request->except('password');
            $data['password'] = bcrypt($request->password);
            $createUser = $user->create($data);
            if ($createUser) {
                return response()->json([
                    'success' => true,
                    'massage' => 'Tạo tài khoảng thành công'
                ], 200);
            } else {
                return response()->json([
                    'error' => true,
                    'massage' => 'Tạo tài khoảng không thành công'
                ], 200);
            }
        }
    }
    public function login(Request $request, User $user)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'user'    => Auth::user()
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message'   => 'Email hoặc Password không chính xác',
            ], 200);
        }
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'success' => true
        ], 200);
    }

    public function getAccount(Category $category)
    {
        $data = [
            'categories' => $category->where('parent_id', 0)->get(),
            'info_user'  => Auth::user(),
            'list_order' => Order::where('user_id', Auth::user()->id)->get(),
        ];
        return view('frontend.account', $data);
    }
}