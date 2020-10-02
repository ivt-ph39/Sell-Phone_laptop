<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
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
            'ct_name' => 'required|unique:contacts',
            'ct_content' => 'required|max:50'
        ];
    }
    public function messages()
    {
        return [
            'ct_name.required'      => 'Tên không được để trống',
            'ct_name.unique'        => 'Tên đã tồn tại',
            'ct_content.required'   => 'Nội dung không được để trống'
        ];
    }
}