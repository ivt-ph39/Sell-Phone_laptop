<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|min:2',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8',
            'address'  => 'required|min:6'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Không được bỏ trống họ tên',
            'name.min' => 'Kí tự phải từ 2 trở lên',
            'email.required' => 'Không được bỏ trống email',
            'email.email' => 'Không đúng định dạng email',
            'password.required' => 'Không bỏ trống mật khẩu',
            'password.min' => 'Mật khẩu có từ 8 kí tự trở lên',
            'password.confirmed' => 'Mật khẩu nhập lại không chính xác',
            'address.required' => 'Địa chỉ không được để trống',
            'address.min' => 'Địa chỉ phải có kí tự từ 6 trở lên'
        ];
    }
}
