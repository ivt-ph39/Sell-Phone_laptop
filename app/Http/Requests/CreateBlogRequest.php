<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
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
            'title' => 'required',
            'thumbnail' => 'required',
            'content' => 'required',
            'tag' => 'required|unique:blog_tags,tag',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Không được để trống tiêu đề',
            'thumbnail.required' => 'Không được để trống thumbnail',
            'content.required' => 'không được để trống nội dung',
            'tag.required' => 'Không được để trống tag',
            'tag.unique' => 'Tag bị trùng lặp vui lòng check lại',
        ];
    }
}
