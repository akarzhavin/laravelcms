<h1>Параметры фильтра</h1>
<div class="form-group">
    {{ Form::label('properties[status]','Статус') }}
    {{ Form::select('properties[status]', ['A' => 'Включено', 'D' => 'Выключено', 'H' => 'Скрыто'], empty($filter->status) ?'A': $filter->status, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('properties[display]','Тип отображения') }}
    {{ Form::select('properties[display]', ['D' => 'Развёрнуто', 'C' => 'Свёрнуто'], empty($filter->display) ?'D': $filter->display, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('properties[display_count]','Кол-во отображаемых вариантов фильтра') }}
    {{ Form::number('properties[display_count]', empty($filter->display_count) ?'D': $filter->display_count, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{Form::label('properties[title]','Заголовок')}}
    {{Form::text('properties[title]', empty($filter->title) ?'': $filter->title, array('class' => 'form-control'))}}
</div>

<div class="form-group">
    {{ Form::label('properties[type]','Тип') }}
    {{ Form::select('properties[type]', [
        'feature' => 'Характеристики',
        'price' => 'Цена'
    ], empty($filter->type) ?'': $filter->type, array('class' => 'form-control')
    ) }}
</div>

<div class="form-group">
    {{ Form::label('properties[feature_id]','Харектеристика') }}
    {{ Form::select('properties[feature_id]', $features, empty($filter->feature_id) ?'': $filter->feature_id, array('class' => 'form-control')) }}
</div>

{{--<div class="form-group">--}}
    {{--{{ Form::label('properties[other][round_to]','Шаг') }}--}}
    {{--{{ Form::number('properties[other][round_to]', empty($filter->other['round_to']) ?'': $filter->other['round_to'], array('class' => 'form-control')) }}--}}
{{--</div>--}}

<h4>Выбор категории</h4>

<select name="categories[]" multiple class="form-control">
    @include('admin-partials._select-category', array(
        "categoryTree" => $categoryTree,
        "selectId" => empty($filterCategories) ?[]: $filterCategories,
        "button_name" => "Update"
    ))
</select>
