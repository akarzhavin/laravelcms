@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

            @include('admin-partials._form-error')

            {{ Form::open(
                        array(
                        'action'=> array('FilterController@destroy', $filter->id),
                        'method'=>"DELETE")
                        ) }}
            {{--{{ Form::submit('Destroy!') }}--}}
            <button class="btn btn-danger ui-btn-delete" type="submit">Удалить</button>
            {{ Form::close() }}


            {{ Form::model(
                        $filter,
                        array(
                        'action'=> array('FilterController@update', $filter->id),
                        'method'=>"PATCH",
                        'files' => true)
                        ) }}

            {{--{{Form::submit('Submit', array('class' => 'btn btn-primary'))}}--}}

            <div class="ui-btn-save-div">
                <button class="btn btn-primary ui-btn-save" type="submit">Сохранить</button>
            </div>

            @include('admin-partials._filter-form',array('productButton'=>'Edit Product'))
            {{ Form::close() }}
        </el-col>
    </el-row>
</div>


@include('admin_them.footer')