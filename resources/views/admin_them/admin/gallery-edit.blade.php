@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">
            <h3>Редактирование галереи</h3>

            @include('admin-partials._form-error')

            <form method="POST" action="/admin/gallery/{{ $gallery->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="ui-btn-save-div">
                    {{Form::submit('Сохранить', array('class' => 'btn btn-primary ui-btn-save'))}}
                </div>

                @include('admin-partials._gallery-form')

            </form>

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')