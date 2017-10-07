{{ Form::label('feature_values['. $key .'][values_id]', $feature->description->title) }}

        <?php
        foreach($feature->values as $value)
        {
            echo "<div class='form-check'><label class='custom-control custom-checkbox'>";
            echo Form::checkbox(
                'feature_values['. $key .'][values_id][]',
                $value->id,
                isset($selectValue) && $selectValue->contains('value_id', $value->id),
                array('class'=>'custom-control-input')
            );
            echo "<span class='custom-control-indicator'></span>";
            echo Form::label('feature_values['. $key .'][values_id][]', $value->value, array('class'=>'custom-control-description'));
            echo "</label></div>";
        }
        ?>

{{ Form::hidden('feature_values['. $key .'][id]', $feature->id) }}