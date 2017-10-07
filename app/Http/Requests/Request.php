<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function filter(string $key = null)
    {
        $filterData =  parent::only($this->filterKeys);

        if(!empty($key) && isset($filterData[$key])){
            $filterData = $filterData[$key];
        }

        return $this->array_filter_recursive($filterData);
    }

    private function array_filter_recursive($input)
    {
        foreach ($input as $key => &$value)
        {
            if (is_array($value)) {
                $value = $this->array_filter_recursive($value);
            } elseif($value === null) {
                unset($input[$key]);
            }
        }

        return array_filter($input);
    }
}
