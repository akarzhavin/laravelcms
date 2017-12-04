@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <features-edit></features-edit>
    <el-row>
        <el-col :span="24">

            {{ Form::open(
                array(
                'action'=> array('FeatureController@destroy', $feature->id),
                'method'=>"DELETE")
                ) }}
                <button id="destroy" class="btn btn-danger ui-btn-delete" type="submit">Удалить</button>
            {{ Form::close() }}

            {{ Form::model(
                $feature,
                array(
                'action'=> array('FeatureController@update', $feature->id),
                'method'=>"PATCH",
                'files' => true)
                ) }}
                <div class="ui-btn-save-div">
                    <button id="submit" class="btn btn-primary ui-btn-save" type="submit">Сохранить</button>
                </div>

                <h4>Редактирование характеристики</h4>

                @include('admin-partials._form-error')

                @include('admin-partials._feature-form',array('productButton'=>'Edit Product'))
            {{ Form::close() }}

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')
