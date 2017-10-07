<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 29.08.2017
 * Time: 10:03
 */

namespace App\Http\Models;

use Illuminate\Support\Facades\Validator;

class FeatureValuesCollection
{
    private $collection;

    public function __construct()
    {
        $this->collection = array();
    }

    public function addItem($feature_id, $type, $value, $order = 0, $description = null)
    {
        $data['feature_id'] = $feature_id;
        $data['value_string'] = null;
        $data['value_bool'] = null;
        $data['value_double'] = null;

        $data['description'] = $description;
        $data['order'] = $order;

        switch($type){
            case 'CheckMulti':
                $data['value_string'] = $value;
                break;
            case 'CheckSingle':
                $data['value_bool'] = $value;
                break;
            case 'SelectNum':
                $data['value_double'] = $value;
                break;
            case 'SelectText':
                $data['value_string'] = $value;
                break;
            default:
                return false;
        }

        $fails = Validator::make(
            $data,
            [
                'feature_id' => 'integer|min:1',
                'value_string' => 'nullable|max:255',
                'value_bool' => 'nullable|boolean',
                'value_double' => 'nullable|numeric',
                'description' => 'nullable|max:255',
                'order' => 'integer|min:0'
            ]
        )->fails();

        if($fails){
            return false;
        } else {
            array_push($this->collection, $data);
            return true;
        }
    }

    public function get()
    {
        return $this->collection;
    }

    public function save()
    {
        FeatureValue::insert($this->collection);
    }

    public function initByFeatures()
    {

    }
}