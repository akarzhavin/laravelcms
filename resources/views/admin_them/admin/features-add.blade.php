@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

            <h4>Добавить характеристику</h4>

            @include('admin-partials._form-error')

            {{ Form::open( array('action' => "FeatureController@store")) }}
            <div class="ui-btn-save-div">
                <button id="submit" class="btn btn-primary ui-btn-save" type="submit">Сохранить</button>
            </div>
            @include('admin-partials._feature-form',array("button_name" => "Add"))
            {{ Form::close() }}

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')