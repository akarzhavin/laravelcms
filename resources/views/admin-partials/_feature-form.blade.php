{{--<h4>Feature parameters</h4>--}}
<div class="form-group">
    {{ Form::label('properties[status]','Статус') }}
    {{ Form::select('properties[status]', ['A' => 'Включено', 'D' => 'Выключено', 'H' => 'Скрыто'], empty($feature->status) ?'A': $feature->status, array('id' => 'awesomee', 'class' => 'form-control') ) }}
</div>
<div class="form-group">
    {{ Form::label('properties[type]','Тип характеристики') }}
    {{ Form::select('properties[type]', [
        'Флажок' => [
            'CheckSingle' => 'Один',
            'CheckMulti' => 'Несколько',
        ],
        'Список вариантов' => [
            'SelectNum' => 'Текст',
            'SelectText' => 'Число',
            //'E' => 'Бренд',
        ],
        //'Другие' => [
        //    'T' => 'Текст',
        //    'O' => 'Число',
        //],
    ], empty($feature->type) ?'': $feature->type, array('id' => 'awesomee', 'class' => 'form-control')
    ) }}
</div>
{{--<h4>Feature description</h4>--}}
<div class="form-group">
    {{Form::label('description[title]','Заголовок')}}
    {{Form::text('description[title]', empty($feature->description->title) ?'': $feature->description->title, array('class' => 'form-control'))}}

    {{Form::label('description[description]','Описание')}}
    {{Form::textarea('description[description]', empty($feature->description->description) ?'': $feature->description->description, array('class' => 'form-control'))}}
</div>

<div class="form-group">
    {{Form::label('description[prefix]','Префикс')}}
    {{Form::text('description[prefix]', empty($feature->description->prefix) ?'': $feature->description->prefix, array('class' => 'form-control'))}}

    {{Form::label('description[suffix]','Суффикс')}}
    {{Form::text('description[suffix]', empty($feature->description->suffix) ?'': $feature->description->suffix, array('class' => 'form-control'))}}
</div>


<h4>Выбор категорий</h4>
<div class="form-group">
    {{ Form::label('exampleFormControlSelect2','Категории (зажмите Ctrl, чтобы выбрать несколько категорий)') }}
    <select multiple class="form-control" name="categories[]" id="exampleFormControlSelect2">
        @include('admin-partials._select-category', array(
            "categoryTree" => $categoryTree,
            "selectId" => empty($productCategories) ?[]: $productCategories,
            "button_name" => "Update"
        ))
    </select>
</div>

<h4>Варианты</h4>
<table class="table table-striped shop_tab">
    <thead>
    <tr>
        <th></th>
        {{--<th>Вариант</th>--}}
        {{--<th>Description</th>--}}
        {{--<th>Order</th>--}}
        <th></th>
    </tr>
    </thead>

    <tbody>
    @if(!empty($values))
    @foreach($values as $i => $item)
        <tr>
            <td>{{ Form::text('values['. $i .'][value]', empty($item->value) ?'': $item->value, array('class' => 'form-control quantityVariable')) }}</td>
            <td>
                {{ Form::hidden('values['. $i .'][id]', $item->id ) }}
                <button id="delete-variant" class="btn btn-danger" type="button" onclick="$(this).closest('tr').remove();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
            </td>
        </tr>
    @endforeach
    @endif
    </tbody>

    @php
        isset($i) ? $i++ : $i = 0;
    @endphp

    <tfoot>
        <tr class="quantityVariableTr">
            <td>
                {{ Form::text('values['. $i .'][value]', '', array('class' => 'form-control quantityVariable')) }}
            </td>
        </tr>
        <tr>
            <td>
                <button id="add-variant" class="btn btn-primary btn-img-product-form" type="button" onclick="addNewVariable()"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
            </td>
        </tr>
    </tfoot>
</table>
