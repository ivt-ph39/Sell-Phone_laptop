<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
            'name' => "required|unique:sliders,name,$id"
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Tên không được để trống',
            'name.unique'        => 'Tên đã tồn tại'
        ];
    }
}