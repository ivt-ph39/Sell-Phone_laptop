<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
            'content' => 'min:6',
            'name' => 'min:6',
            'email' => 'email',
            'phone' => 'regex:/^0+[0-9]{9}$/'
        ];
    }
    public function messages()
    {
        return [
            'name.min' => 'Tên không dưới 6 kí tự',
            'email.email' => 'Phải là email "example@gmail.com"',
            'phone.regex' => 'Không đúng định dạng phone VN : 0123456789'
        ];
    }
}
