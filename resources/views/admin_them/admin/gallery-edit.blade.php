@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">
            <h3>Редактирование галереи</h3>

            @include('admin-partials._form-error')

            <form method="POST" action="/admin/gallery/{{ $gallery->id }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="ui-btn-save-div">
                    {{Form::submit('Сохранить', array('class' => 'btn btn-primary ui-btn-save'))}}
                </div>

                <div class="form-group">
                    <label for="title">Заголовок</label>
                    {{Form::text('properties[title]', empty($gallery->title) ?'': $gallery->title, array('class' => 'form-control'))}}

                    {{Form::label('properties[description]','Описание')}}
                    {{Form::textarea('properties[description]', empty($gallery->description) ?'': $gallery->description, array('class' => 'form-control'))}}
                </div>
            </form>

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')