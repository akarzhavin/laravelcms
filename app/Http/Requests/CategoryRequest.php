<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
{

    protected $filterKeys = [
        'parent_id', 'status', 'order',
        'title', 'description', 'meta_keywords', 'meta_description', 'page_title'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //logic already checked using middleware
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
            'title'            => 'required',
            'status'           => "required|in:A,H,D",
            'parent_id'        => 'required|integer',
            'order'            => 'integer'
        ];
    }
}
