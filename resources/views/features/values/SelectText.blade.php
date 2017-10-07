<?php
    if(!empty($selectValue)){
        $selectValue = $selectValue->first();
        if(!empty($selectValue)){
            $selectValue = $selectValue->value_id;
        } else {
            $selectValue = null;
        }
    }
?>

<div class="form-group">
    {{ Form::label('feature_values['. $key .'][value_id]', $feature->description->title) }}
    {{ Form::select('feature_values['. $key .'][value_id]', $feature->values->pluck('id', 'value')->flip(), empty($selectValue) ?: $selectValue, array('class'=>'form-control')) }}
    {{ Form::hidden('feature_values['. $key .'][id]', $feature->id) }}
</div>