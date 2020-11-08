<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionChildrenRequest extends FormRequest
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
            'name' => 'required|min:6',
            'description' => 'required|min:6',
            'keycode' => 'required|regex:/^[a-z0-9]*+_+[a-z0-9]*$/',
            'parent_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'name.min' => 'Kí tự phải lớn hơn 6',
            'description.required' => 'Không được để trống',
            'keycode.required' => 'Không được để trống',
            'keycode.regex' => 'Chưa đúng định dạng Ex: "list_user"',
            'parent_id.required' => 'Không được để trống',
        ];
    }
}
