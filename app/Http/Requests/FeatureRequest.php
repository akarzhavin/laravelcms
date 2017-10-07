<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FeatureRequest extends Request
{

    protected $filterKeys = [
        'properties.status',
        'properties.type',

        'values.id',
        'values.value',
//        'values.description',
//        'values.order',
//        'values.page_title',
//        'values.meta_keywords',
//        'values.meta_description',

        'description.title',
        'description.description',
        'description.prefix',
        'description.suffix',

        'categories',
    ];

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
            'properties.status' => "required|in:A,H,D",
            'properties.type' => "required",

            'values.*.id' => 'numeric',
            'values.*.value' => 'required_with:value.*.id|max:128',
//            'values.*.order' => 'numeric',
//            'values.*.page_title' => 'max:255',
//            'values.*.meta_keywords' => 'max:255',
//            'values.*.meta_description' => 'max:255',

            'description.title' => 'max:255',
            'description.prefix' => 'max:128',
            'description.suffix' => 'max:128',

            'categories' => 'required',
            'categories.*' => 'required|numeric',
        ];
    }
}
