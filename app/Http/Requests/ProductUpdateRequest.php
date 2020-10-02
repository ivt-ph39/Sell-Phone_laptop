<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $id = $this->id;
        return [

            "p_name"        => "required|max:255|unique:products,p_name,$id",
            'p_number'      => 'required|numeric|min:0',
            'p_price'       => 'required|numeric',
            'p_sale'        => 'numeric|max:100',
            'p_category_id' => 'required',
            'p_brand_id' => 'required',

            'p_avatar'      => 'image',
            'p_title'       => 'required',
        ];
    }
    public function messages()
    {
        return [
            'p_name.required'        => 'Tên sản phẩm không được để trống',
            'p_name.unique'          => 'Tên sản phẩm đã tồn tại',
            'p_name.max'             => 'Tên sản phẩm không dài quá 255 kí tự',

            'p_number.required'      => 'Sl sản phẩm không được để trống',
            'p_number.numeric'       => 'Sl sản phẩm phải là số',
            'p_number.min'           => 'Sl sản phẩm không được nhỏ hơn 0',

            'p_price.required'       => 'Giá sản phẩm không được để trống',
            'p_price.numeric'        => 'Giá sản phẩm phải là số',

            'p_sale.numeric'         => 'Giảm giá phải là số',
            'p_sale.max'             => 'Giảm giá phải nhỏ hơn 100',

            'p_category_id.required' => 'Danh mục không được để trống',
            'p_brand_id.required'    => 'Thương hiệu không được để trống',

            'p_avatar.image'         => 'File đươc chọn phải là file ảnh',
            'p_title.required'       => 'Tiêu đề sản phẩm không được để trống',

        ];
    }
}