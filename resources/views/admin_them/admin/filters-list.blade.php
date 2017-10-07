@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

        <span class="button-addAll">
            <a class='btn btn-info' href="/admin/filter/create">
                <span class="glyphicon glyphicon-edit"></span><i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </span>

        <table class="table table-striped shop_tab">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Тип</th>

            </tr>
            </thead>

            <?php $i=0;?>

            @foreach($filters as $item)
                <?php $i++?>
                <tr style="">
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->type }}</td>
                    <td class="text-center">
                        <a class='btn btn-info btn-sm' href="/admin/filter/{{$item->id}}/edit ">
                            <span class="glyphicon glyphicon-edit"></span>Редактировать</a>

                        {{ Form::open(array('url' => '/admin/filter/' . $item->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Удалить', array('class' => 'btn btn-warning btn-sm', 'id'=>'deleteButton'.$i)) }}
                        {{ Form::close() }}

                    </td>
                </tr>
            @endforeach
        </table>
        {{ $filters->links() }}
        </el-col>
    </el-row>
</div>


@include('admin_them.footer')