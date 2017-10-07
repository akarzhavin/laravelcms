@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

            @include('admin-partials._form-error')

            {{ Form::open(
                array(
                'action'=> array('CategoryController@destroy', $category->id),
                'method'=>"DELETE")
                ) }}
                <button class="btn btn-danger ui-btn-delete" type="submit">Удалить</button>
            {{ Form::close() }}

            {{ Form::model(
                compact('category', 'categoryTree'),
                array(
                "action" => array("CategoryController@update", $category->id),
                "method" => "PATCH")
            ) }}

                <div class="ui-btn-save-div">
                    {{--{{Form::submit('Сохранить', array('class' => 'btn btn-primary ui-btn-save'))}}--}}
                    <button class="btn btn-primary ui-btn-save" type="submit">Сохранить</button>
                </div>

                <h4>Редактирование категории</h4>

                @include('admin-partials._category-form',array("button_name" => "Update"))

            {{Form::close()}}

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')