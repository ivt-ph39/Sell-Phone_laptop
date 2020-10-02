<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'c_name'    => 'required|unique:categories',
            'c_parent'  => 'required',

            'c_icon'    => "required_without:c_image",
            'c_image'   => 'required_without:c_icon',
        ];
    }
    public function messages()
    {
        return [
            'c_name.required' => 'Tên danh mục không được để trống',
            'c_name.unique' => 'Tên danh mục đã tônf tại',
            'c_parent.required' => 'Danh mục cha không được để trống',

            'c_icon.required_without' => 'Icon hoặc Ảnh cần được điền',
            'c_image.required_without' => 'Icon hoặc Ảnh cần được điền'
        ];
    }
}