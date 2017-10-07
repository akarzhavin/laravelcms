@include('admin_them.header')

@include('admin_them.navbar')

<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

            <span class="button-addAll">
                <a class='btn btn-info btn' href="/admin/categories/create ">
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

                    @foreach($categories as $item)
                        <?php $i++?>
                        <tr style="{{ !$item->trashed() ?: 'color:red;' }}">
                            <td>{{ $item->description->title }}</td>
                            <td class="text-center">
                                {{--<a class='btn btn-info btn-sm' href="/shop/listing/{{$item->id}} ">--}}
                                <a class='btn btn-info btn-sm'>
                                    <span class="glyphicon glyphicon-edit"></span> Продукты категории </a>
                                <a class='btn btn-info btn-sm' href="/admin/categories/{{$item->id}}/edit ">
                                    <span class="glyphicon glyphicon-edit"></span> Редактировать</a>

                                {{ Form::open(array('url' => '/admin/categories/' . $item->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Удалить', array('class' => 'btn btn-warning btn-sm', 'id'=>'deleteButton'.$i)) }}
                                {{ Form::close() }}

                            </td>
                        </tr>
                    @endforeach
                </table>
            {{ $categories->links() }}
        </el-col>
    </el-row>
</div>

@include('admin_them.footer')