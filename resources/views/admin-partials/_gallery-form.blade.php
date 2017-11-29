<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 29.11.2017
 * Time: 21:32
 */
?>
<ul class="nav nav-tabs" id="productsAddTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general"
           aria-expanded="true">Основное</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images"
           aria-expanded="true">Изображения</a>
    </li>
</ul>

<div class="tab-content" id="productsAddTabsContent">
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <h1>Настройки</h1>
        <label for="title">Заголовок</label>
        {{Form::text('properties[title]', empty($gallery->title) ?'': $gallery->title, array('class' => 'form-control'))}}

        {{Form::label('properties[description]','Описание')}}
        {{Form::textarea('properties[description]', empty($gallery->description) ?'': $gallery->description, array('class' => 'form-control'))}}
    </div>

    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <h1>Изображения</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Order</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($images))
                @foreach($images as $key => $image)
                    <tr>
                        <th>
                            <label class="custom-control custom-radio">
                                {{ Form::radio('images_main', $key, $image['pivot']['main'], array('class' => 'custom-control-input')) }}
                                <span class="custom-control-indicator"></span>
                            </label>
                        </th>

                        <td>
                            <div class="img-product-form">
                                <img class="placeholder" src="{{ $image['thumbnail'] }}" alt="{{ $image['alt'] }}">
                                {{ Form::file('images['. $key .'][file]' ,array('id' => '', 'class' => 'img-input')) }}
                            </div>
                        </td>
                        <td>
                            {{ $image['name'] }}
                        </td>
                        <td>
                            {{ Form::number('images['. $key .'][order]', (empty($image['pivot']['order']) ? 0 : $image['pivot']['order']), array('class' => 'form-control') ) }}
                        </td>
                        {{ Form::hidden('images['. $key .'][id]', $image['id'] ) }}

                        <td>
                            <button class="btn btn-danger btn-img-product-form" type="button"
                                    onclick="$(this).closest('tr').remove();"><i class="fa fa-minus-circle"
                                                                                 aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif

            @php
            isset($key) ? $key++ : $key = 0;
            @endphp

            <tr>
                <th>
                    <label class="custom-control custom-radio">
                        {{ Form::radio('images_main', $key , '', ['class' => 'custom-control-input']) }}
                        <span class="custom-control-indicator"></span>
                    </label>
                </th>

                <td>
                    <div class="img-product-form">
                        <img class="placeholder" src="/img/admin/add-image.png" alt="">
                        {{ Form::file('images['. $key .'][file]' , array('id'=>'', 'class' => 'img-input')) }}
                    </div>
                </td>

                <td>
                    {{ Form::number('images['. $key .'][order]', 0, array('class' => 'form-control')) }}
                </td>

                <td>
                    <button class="btn btn-danger btn-img-product-form" type="button"
                            onclick="$(this).closest('tr').remove();"><i class="fa fa-minus-circle"
                                                                         aria-hidden="true"></i>
                    </button>
                </td>

            </tr>

            <tr>
                <td>
                    <button class="btn btn-primary btn-img-product-form" type="button" onclick="addNewImg()"><i
                                class="fa fa-plus-circle" aria-hidden="true"></i></button>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>