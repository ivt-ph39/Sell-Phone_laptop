<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

            'p_name' => 'required|unique:products|max:255',
            'p_number' => 'required|numeric|min:0',
            'p_price' => 'required|numeric',
            'p_category_id' => 'required',
            'p_brand_id' => 'required',
            'p_avatar' => 'required',
            'p_image_detail' => 'required',
            'p_title' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'p_name.required' => 'Tên sản phẩm không được để trống',
            'p_name.unique' => 'Tên sản phẩm đã tồn tại',
            'p_name.max' => 'Tên sản phẩm không dài quá 255 kí tự',

            'p_number.required' => 'Sl sản phẩm không được để trống',
            'p_number.numeric' => 'Sl sản phẩm phải là số',
            'p_number.min' => 'Sl sản phẩm không được nhỏ hơn 0',

            'p_price.required' => 'Giá sản phẩm không được để trống',
            'p_price.numeric' => 'Giá sản phẩm phải là số',



            'p_category_id.required' => 'Danh mục không được để trống',
            'p_brand_id.required'    => 'Thương hiệu không được để trống',


            'p_avatar.required' => 'Ảnh sản phẩm không được để trống',

            'p_image_detail.required' => 'Ảnh chi tiết không được để trống',

            'p_title.required' => 'Tiêu đề sản phẩm không được để trống',

        ];
    }
}