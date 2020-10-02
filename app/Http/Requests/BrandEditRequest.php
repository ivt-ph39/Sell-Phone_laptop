<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandEditRequest extends FormRequest
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

        if ($this->delete_avatar == 0) {
            $data = [
                'name'   => "required|unique:brands,name,$id"
            ];
        } else {
            $data = [
                'name'   => "required|unique:brands,name,$id",
                'avatar' => "required|image"
            ];
        }
        return  $data;
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