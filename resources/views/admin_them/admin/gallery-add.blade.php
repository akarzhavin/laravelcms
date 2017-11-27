@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">
            <h3>Новая галерея</h3>

            @include('admin-partials._form-error')

            {{ Form::open( array('action' => "GalleryController@store")) }}
            <div class="ui-btn-save-div">
                {{Form::submit('Сохранить', array('class' => 'btn btn-primary ui-btn-save'))}}
            </div>

            <div class="form-group">
                <label for="title">Заголовок</label>
                {{Form::text('properties[title]', empty($gallery->title) ?'': $gallery->title, array('class' => 'form-control'))}}

                {{Form::label('properties[description]','Описание')}}
                {{Form::textarea('properties[description]', empty($gallery->description) ?'': $gallery->description, array('class' => 'form-control'))}}
                {{--<Wysiwyg />--}}
            </div>

            {{--<div class="form-group">--}}
                {{--{{ Form::label('status','Статус') }}--}}
                {{--{{ Form::select('status', ['A' => 'Включено', 'H' => 'Скрыто', 'D' => 'Выключено'], empty($gallery->status) ?'': $gallery->status, array('class' => 'form-control')) }}--}}
            {{--</div>--}}

            {{ Form::close() }}

        </el-col>
    </el-row>
</div>

@include('admin_them.footer')