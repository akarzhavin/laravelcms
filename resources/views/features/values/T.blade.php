{{ Form::label('featuresq['. $key .'][value]', $feature->description->title) }}
{{ Form::text('featuresq['. $key .'][value]', FeatureValueShell::init($item)->value, array('class'=>'form-control')) }}
{{ Form::hidden('featuresq['. $key .'][id]', $feature->id) }}