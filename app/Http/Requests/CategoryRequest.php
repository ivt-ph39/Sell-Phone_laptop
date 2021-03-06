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
            'name'    => 'required|unique:categories',
            'parent_id'  => 'required',

            'icon'    => "required_without:image",
            'image'   => 'required_without:icon',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'parent_id.required' => 'Danh mục cha không được để trống',

            'icon.required_without' => 'Icon hoặc Ảnh cần được điền',
            'image.required_without' => 'Icon hoặc Ảnh cần được điền'
        ];
    }
}