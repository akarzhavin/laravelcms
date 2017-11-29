<?php

namespace App\Http\Requests;

class GalleryRequest extends Request
{
    protected $filterKeys = [
        'properties.title',
        'properties.description',
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
            'properties.title' => "required|max:255",
            'properties.description' => "max:255",

            //Images
            'images_main' => 'integer',
            'images.*.id' => 'integer',
            'images.*.order' => 'integer',
            'images.*.file' => 'image',
        ];
    }
}
