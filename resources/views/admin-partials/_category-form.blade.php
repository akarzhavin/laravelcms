<div class="form-group">
    <label for="title">Заголовок</label>
    {{Form::text('title', empty($category->description->title) ?'': $category->description->title, array('class' => 'form-control'))}}

    {{Form::label('description','Описание')}}
    {{Form::textarea('description', empty($category->description->description) ?'': $category->description->description, array('class' => 'form-control'))}}
    <Wysiwyg v-model="areaData" />
</div>

<div class="form-group">
    
    {{ Form::label('status','Статус') }}
    {{ Form::select('status', ['A' => 'Включено', 'H' => 'Скрыто', 'D' => 'Выключено'], empty($category->status) ?'': $category->status, array('class' => 'form-control')) }}

    {{ Form::label('select-category','Родительская категория') }}
    <select class="form-control" id="parent_id" name="parent_id">
        @include('admin-partials._select-category', array(
        "selectId" => empty($category->parent_id) ? 0 : $category->parent_id,
        "categoryTree" => $categoryTree,
        "button_name" => "Update"
        ))
    </select>
</div>

<div class="form-group">
    {{Form::label('meta_keywords','Мета-слова')}}
    {{Form::text('meta_keywords', empty($category->description->meta_keywords) ?'': $category->description->meta_keywords, array('class' => 'form-control'))}}

    {{Form::label('meta_description','Мета-описание')}}
    {{Form::text('meta_description', empty($category->description->meta_description) ?'': $category->description->meta_description, array('class' => 'form-control'))}}

    {{Form::label('page_title','Заголовок страницы (в поисковой системе)')}}
    {{Form::text('page_title', empty($category->description->page_title) ?'': $category->description->page_title, array('class' => 'form-control'))}}
</div>

{{--{{Form::submit($button_name, array('class' => 'btn btn-primary'))}}--}}
