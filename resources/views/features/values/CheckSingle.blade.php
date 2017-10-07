
{{--{{ Form::label('feature_values['. $key .'][value_id]', $feature->description->title, array('class' => 'form-check-label')) }}--}}
<div class="form-check">
<label class="custom-control custom-checkbox">
    <?php
    if(empty($selectValue->first()->value_id)){
        $tmp_value = false;
    } else {
        $tmp_value = true;
    }

    echo Form::checkbox(
            'feature_values['. $key .'][value_id]',
            $feature->values->first()->id,
            $tmp_value, array('class'=>'custom-control-input')
    );
    ?>

    <span class="custom-control-indicator"></span>
    {{ Form::label('feature_values['. $key .'][value_id]', $feature->description->title) }}
</label>
</div>
{{ Form::hidden('feature_values['. $key .'][id]', $feature->id) }}


