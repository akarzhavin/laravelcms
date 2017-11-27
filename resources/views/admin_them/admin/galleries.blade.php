@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

            <span class="button-addAll">
                <a class='btn btn-info btn' href="/admin/gallery/create ">
                    <span class="glyphicon glyphicon-edit"></span><i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </span>

            <table class="table table-striped shop_tab">
                <thead>
                <tr>
                    <th>Имя</th>
                </tr>
                </thead>

                <?php $i=0;?>

                @foreach($galleries as $item)
                    <?php $i++?>
                    <tr style="{{ !$item->trashed() ?: 'color:red;' }}">
                        <td>{{ $item->title }}</td>
                        <td class="text-center">
                            {{--<a class='btn btn-info btn-sm' href="/shop/listing/{{$item->id}} ">--}}
                            <a class='btn btn-info btn-sm' href="/admin/gallery/{{$item->id}}/edit ">
                                <span class="glyphicon glyphicon-edit"></span> Редактировать</a>

                            {{ Form::open(array('url' => '/admin/gallery/' . $item->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Удалить', array('class' => 'btn btn-warning btn-sm', 'id'=>'deleteButton'.$i)) }}
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $galleries->links() }}
        </el-col>
    </el-row>
</div>

@include('admin_them.footer')