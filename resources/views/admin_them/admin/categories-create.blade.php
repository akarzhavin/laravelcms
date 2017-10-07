@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">
            <h3>Новая категория</h3>

            @include('admin-partials._form-error')

            {{ Form::open( array('action' => "CategoryController@store")) }}
            <div class="ui-btn-save-div">
                {{Form::submit('Сохранить', array('class' => 'btn btn-primary ui-btn-save'))}}
            </div>
            @include('admin-partials._category-form',array("button_name" => "Add"))
            {{ Form::close() }}

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')