{{ Form::label('featuresq['. $key .'][value]', $feature->description->title) }}
{{ Form::text('featuresq['. $key .'][value]', empty($value->value) ?null: $value->value, array('class'=>'form-control')) }}
{{ Form::hidden('featuresq['. $key .'][id]', $feature->id) }}