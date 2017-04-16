<?php

namespace MyBlog\Http\Requests;

use MyBlog\Http\Requests\Request;

class PostRequest extends Request
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
            'author_id' => 'required',
            'title' => 'required|min:15',
            'content' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'author_id.required'    => 'A <i>author</i>author field is required',
            'title.required'        => 'A <i>title</i> field is required',
            'title.min'             => 'A <i>title</i> field must have at least 15 characters',
            'content.required'      => 'A <i>content</i> field is required',
        ];
    }
}
