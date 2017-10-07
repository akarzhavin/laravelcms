<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FilterRequest extends Request
{

    protected $filterKeys = [
        'properties.title',
        'properties.type',
        'properties.status',
        'properties.display',
        'properties.display_count',
        'properties.feature_id',
        'properties.other.round_to',
        'categories'
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
            'properties.title' => "required|max:128",
            'properties.type' => "required|in:feature,price",
            'properties.status' => "required|in:A,H,D",
            'properties.display' => "required|in:D,C",
            'properties.display_count' => "required|integer|min:1|max:9999",

            'properties.feature_id' => "required_if:properties.type,feature|integer|min:1",
            'properties.other.round_to' => "required_if:properties.type,price|numeric|min:0|digits_between:1,5",
            'categories.*' => 'integer|min:1',
        ];
    }
}
