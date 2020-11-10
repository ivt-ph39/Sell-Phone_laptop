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
            "name"        => "required|max:255|unique:products,name,$id",
            'quantity'      => 'required|numeric|min:0',
            'price'       => 'required|numeric',
            'sale'        => 'numeric|max:100',
            'category_id' => 'required',
            'brand_id' => 'required',
            'avatar'      => 'image',
            'title'       => 'required',
            'tag'       => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'        => 'Tên sản phẩm không được để trống',
            'name.unique'          => 'Tên sản phẩm đã tồn tại',
            'name.max'             => 'Tên sản phẩm không dài quá 255 kí tự',

            'quantity.required'      => 'Sl sản phẩm không được để trống',
            'quantity.numeric'       => 'Sl sản phẩm phải là số',
            'quantity.min'           => 'Sl sản phẩm không được nhỏ hơn 0',

            'price.required'       => 'Giá sản phẩm không được để trống',
            'price.numeric'        => 'Giá sản phẩm phải là số',

            'sale.numeric'         => 'Giảm giá phải là số',
            'sale.max'             => 'Giảm giá phải nhỏ hơn 100',

            'category_id.required' => 'Danh mục không được để trống',
            'brand_id.required'    => 'Thương hiệu không được để trống',

            'avatar.image'         => 'File đươc chọn phải là file ảnh',
            'title.required'       => 'Tiêu đề sản phẩm không được để trống',
            'tag.required'       => 'Từ khóa không được để trống',


        ];
    }
}