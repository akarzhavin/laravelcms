@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

            @include('admin-partials._form-error')

            {{ Form::open( array('action' => "FilterController@store")) }}
            <div class="ui-btn-save-div">
                {{Form::submit('Сохранить', array('class' => 'btn btn-primary ui-btn-save'))}}
            </div>
            @include('admin-partials._filter-form',array('productButton'=>'Add filter'))
            {{ Form::close() }}

        </el-col>
    </el-row>
</div>


@include('admin_them.footer')