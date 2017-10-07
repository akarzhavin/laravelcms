<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    protected $filterKeys = [
        'general.status',
//        'general.product_code',

//        'properties.amount',
//        'properties.weight',
//        'properties.length',
//        'properties.width',
//        'properties.height',

//        'properties.shipping_freight',
//        'properties.is_edp',
//        'properties.edp_shipping',
//        'properties.unlimited_download',
//        'properties.tracking',
//        'properties.free_shipping',
//        'properties.zero_price_action',
//        'properties.is_returnable',
//        'properties.return_period',
//        'properties.out_of_stock_actions',

//        'properties.min_qty',
//        'properties.max_qty',
//        'properties.qty_step',
//        'properties.list_qty_count',

        'description.title',
        'description.short_title',
        'description.short_description',
        'description.full_description',
        'description.meta_keywords',
        'description.meta_description',
        'description.search_words',
        'description.page_title',
        'description.promo_text',

        'prices.guest.price',

        'categories',
        'category_main',
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
            //General
            'general.status' => "required|in:A,H,D",
            'general.product_code' => 'alpha_dash|max:255',

            //Parameters
//            'properties.amount' => 'numeric',
//            'properties.weight' => 'numeric',
//            'properties.length' => 'numeric',
//            'properties.width' => 'numeric',
//            'properties.height' => 'numeric',

//            'properties.shipping_freight' => 'numeric',
//            'properties.is_edp' => 'alpha|max:1',
//            'properties.edp_shipping' => 'alpha|max:1',
//            'properties.unlimited_download' => 'alpha|max:1',
//            'properties.tracking' => 'alpha|max:1',
//            'properties.free_shipping' => 'alpha|max:1',
//            'properties.zero_price_action' => 'alpha|max:1',
//            'properties.is_returnable' => 'alpha|max:1',
//            'properties.return_period' => 'numeric',
//            'properties.out_of_stock_actions' => 'alpha|max:1',

            //Quantity
//            'properties.min_qty' => 'integer',
//            'properties.max_qty' => 'integer',
//            'properties.qty_step' => 'integer',
//            'properties.list_qty_count' => 'integer',

            //Features
            'feature_values.*.id' => 'integer',
            'feature_values.*.value_id' => 'sometimes|numeric|required_without:feature_values.*.values_id',
            'feature_values.*.values_id.*' => 'sometimes|numeric|required_without:feature_values.*.value_id',

            //Description
            'description.title' => 'required|max:255',
            'description.short_title' => 'max:255',
            'description.meta_keywords' => 'max:255',
            'description.meta_description' => 'max:255',
            'description.promo_text' => 'max:255',

            //Prices
            'prices.guest.price' => 'numeric',

            //Images
            'images_main' => 'integer',
            'images.*.id' => 'integer',
            'images.*.order' => 'integer',
            'images.*.file' => 'image',

            //Categories
            'categories.*' => 'integer',
            'categories' => 'array',
            'category_main' => 'required|integer',
        ];
    }
}
