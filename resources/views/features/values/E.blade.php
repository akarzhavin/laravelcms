{{ Form::label('featuresq['. $key .'][variant_id]', $feature->description->title) }}
{{ Form::select('featuresq['. $key .'][variant_id]', $feature->variants->pluck('id', 'variant')->flip(), empty($value->variant_id) ?: $value->variant_id, array('class'=>'form-control')) }}
{{ Form::hidden('featuresq['. $key .'][id]', $feature->id) }}