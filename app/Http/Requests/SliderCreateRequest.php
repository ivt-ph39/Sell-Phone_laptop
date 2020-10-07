<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderCreateRequest extends FormRequest
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
            'name' => 'required|unique:sliders',
            'path' => 'required|image'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Tên không được để trống',
            'name.unique'        => 'Tên đã tồn tại',
            'path.required'      => 'Baner không được để trống',
            'path.image'         => 'Baner phải là ảnh'
        ];
    }
}