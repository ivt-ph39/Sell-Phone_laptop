<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandCreateRequest extends FormRequest
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
            'name'   => 'required|unique:brands',
            'avatar' => 'required|image'
        ];
    }
    public function messages()
    {
        return [
            'name.required'   => 'Tên thương hiệu không được để trống',
            'name.unique'     => 'Tên thương hiệu đã tồn tại',
            'avatar.required' => 'Avatar không được để trống',
            'avatar.image'    => 'Avatar phải là ảnh'
        ];
    }
}