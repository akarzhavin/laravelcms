{{ Form::label('featuresq['. $key .'][value_num]', $feature->description->title) }}
{{ Form::number('featuresq['. $key .'][value_num]', empty($value->value_num) ?0: $value->vavalue_num, array('class'=>'form-control')) }}
{{ Form::hidden('featuresq['. $key .'][id]', $feature->id) }}