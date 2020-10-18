<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
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
            'name' => 'regex:/^Module+\s+[a-zA-Z0-9]*$/',
            'description' => 'min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Nhập theo định dạng ex : "Module User"',
        ];
    }
}
