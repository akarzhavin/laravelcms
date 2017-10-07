@include('admin_them.header')

@include('admin_them.navbar')


<div class="wrapcontainer" :class="marContain">
    <el-row>
        <el-col :span="24">

        <span class="button-addAll">
            <a class='btn btn-info btn' href="/admin/products/create ">
                <span class="glyphicon glyphicon-edit"></span><i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </span>


            <table class="table table-striped shop_tab">
                <thead>

                <tr>
                    <th>Имя</th>
                    <th>Цены</th>
                    <th>Описание </th>
                    <th>Статус </th>
                    <th class="text-center"></th>
                    {{--<th class="text-center">Update Status</th>--}}
                </tr>

                </thead>


                <?php $i=0 ?>

                @foreach($products as $item)
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $item->description->title or ''}}</td>
                        <td>{{ $item->prices->first()->price or ''}}</td>
                        <td>{{ $item->description->short_description or ''}}</td>
                        <td>{{ $item->status }}</td>
                        <td class="text-center">
                            {{--<a class='btn btn-info btn-sm' href="/admin/products/{{$item->id}}/ ">--}}
                                {{--<span class="glyphicon glyphicon-edit"></span> View</a>--}}
                            <a class='btn btn-info btn-sm' href="/admin/products/{{$item->id}}/edit ">
                                <span class="glyphicon glyphicon-edit"></span> Редактировать</a>
                        </td>

                        <td class="text-center">
{{--                            {{Form::open(array('action'=>"ProductController@updateProductStatus"))}}--}}

                            {{--<input type="hidden" name="id" value="{{$item->id}}">--}}
                            {{--{{ Form::select('status', [--}}
                                           {{--'1' => 'Publish',--}}
                                           {{--'0' => 'Un-publish'--}}
                                           {{--], null, array('id'=>'selectStatus'.$i, 'class' => 'form-control select-fix', 'style' => 'display: inline-block; width: auto')--}}
                                            {{--) }}--}}
                            {{--{{Form::submit('Обновить', array('class' => 'btn btn-primary btn-sm', 'id' => 'updateButton'.$i))}}--}}

                            {{--{{Form::close()}}--}}

                            {{ Form::open(array('url' => '/admin/products/' . $item->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Удалить', array('class' => 'btn btn-warning btn-sm', 'id'=>'deleteButton'.$i)) }}
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
            </table>
        {{ $products->links() }}
        </el-col>
    </el-row>
</div>

@include('admin_them.footer')