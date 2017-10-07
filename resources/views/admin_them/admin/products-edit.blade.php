@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

            @include('admin-partials._form-error')

            {{ Form::open(
                array(
                'action'=> array('ProductController@destroy', $product->id),
                'method'=>"DELETE")
                ) }}
                {{--<button class="btn btn-danger ui-btn-delete" type="submit">Удалить</button>--}}
            {{ Form::close() }}

            {{ Form::model(
                $product,
                array(
                'action'=> array('ProductController@update', $product->id),
                'method'=>"PATCH",
                'files' => true)
                ) }}

                <div class="ui-btn-save-div">
                    <button class="btn btn-primary ui-btn-save" type="submit">Сохранить</button>
                </div>

                @include('admin-partials._product-form')

            {{ Form::close() }}

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')