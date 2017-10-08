<ul class="nav nav-tabs" id="productsAddTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">Основное</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-expanded="true">Изображения</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="characteristics-tab" data-toggle="tab" href="#characteristics" role="tab" aria-controls="characteristics" aria-expanded="true">Характеристики</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="options-tab" data-toggle="tab" href="#options" role="tab" aria-controls="options" aria-expanded="true">Параметры</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="cost-tab" data-toggle="tab" href="#cost" role="tab" aria-controls="cost" aria-expanded="true">Цены</a>
    </li>
</ul>
<div class="tab-content" id="productsAddTabsContent">
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <h1>Описание</h1>
        <div class="form-group">
            {{ Form::label('description[title]', 'Заголовок') }}
            {{ Form::text('description[title]', empty($product->description->title) ?'': $product->description->title, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description[short_title]','Короткий загловок') }}
            {{ Form::text('description[short_title]', empty($product->description->short_title) ?'': $product->description->short_title, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description[short_description]','Короткое описание') }}
            {{ Form::textarea('description[short_description]', empty($product->description->short_description) ?'': $product->description->short_description, array('class'=>'form-control', 'rows' => '3')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description[full_description]','Полное описание') }}
            {{ Form::textarea('description[full_description]', empty($product->description->full_description) ?'': $product->description->full_description, array('class'=>'form-control', 'rows' => '6')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description[meta_keywords]','Мета-слова') }}
            {{ Form::text('description[meta_keywords]', empty($product->description->meta_keywords) ?'': $product->description->meta_keywords, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description[meta_description]','Мета-описание') }}
            {{ Form::text('description[meta_description]', empty($product->description->meta_description) ?'': $product->description->meta_description, array('class'=>'form-control')) }}
        </div>
        {{--<div class="form-group">--}}
        {{--{{ Form::label('description[search_words]','Product search words') }}--}}
        {{--{{ Form::text('description[search_words]', empty($product->description->search_words) ?'': $product->description->search_words, array('class'=>'form-control')) }}--}}
        {{--</div>--}}
        <h1>Статус</h1>
        <div class="form-group">
            {{ Form::select('properties[status]', ['A' => 'Включено', 'D' => 'Выключено', 'H' => 'Скрыто'], empty($product->status)?'':$product->status, array('class' => 'form-control' ))}}
        </div>
    </div>

    <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
        <h1>Категории</h1>

        <div class="form-group">
            {{ Form::label('category_main','Основная категория') }}
            <select class="form-control" id="exampleFormControlSelect1" name="category_main">
                @include('admin-partials._select-category', array(
                "categoryTree" => $categoryTree,
                "selectId" => empty($mainCategoryId) ? 1 : $mainCategoryId,
                "button_name" => "Update"
                ))
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('categories','Категории (зажмите Ctrl, чтобы выбрать несколько категорий)') }}
            <select multiple class="form-control" id="exampleFormControlSelect2" name="categories[]">
                @include('admin-partials._select-category', array(
                    "categoryTree" => $categoryTree,
                    "selectId" => empty($productCategories) ?[]: $productCategories,
                    "button_name" => "Update"
                ))
            </select>
        </div>
    </div>

    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <h1>Изображения</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Order</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @if(!empty($images))
                @foreach($images as $key => $image)
                    <tr>
                        {{--<div class="form-group form-row align-items-center imgKey">--}}
                        <th>
                            {{ Form::radio('images_main', $key, $image['pivot']['main']) }}
                        </th>

                        {{--{{ Form::label('images['. $key .'][file]', $image['name'], array('class' => 'col-md-1 col-xs-2')) }}--}}
                        {{--{{ Form::file('images['. $key .'][file]', array('id'=>'')) }}--}}

                        <td>
                            <div class="img-product-form">
                                <img class="placeholder" src="{{ $image['thumbnail'] }}" alt="{{ $image['alt'] }}">
                                {{--<input class="img-input" type="file" onchange="placeHolderImg(event)">--}}
                                {{--{{ Form::file('images['. $key .'][file]' ,array('id'=>'', 'class' => 'img-input', 'onchange' => 'placeHolderImg(event)')) }}--}}
                                {{ Form::file('images['. $key .'][file]' ,array('id'=>'', 'class' => 'img-input')) }}
                            </div>
                        </td>

                        {{--<label class="custom-file">--}}
                        {{--{{ Form::file('images['. $key .'][file]', array('id'=>'', 'class' => 'custom-file-input', 'onclick' => 'nameImgProduct()')) }}--}}
                        {{--<span class="custom-file-control"></span>--}}
                        {{--</label>--}}

                        {{--{{ Form::label('images['. $key .'][order]','Order') }}--}}
                        <td>
                            {{ Form::number('images['. $key .'][order]', (empty($image['pivot']['order']) ? 0 : $image['pivot']['order']), array('class' => 'form-control') ) }}
                        </td>
                        {{--{{ Form::hidden('images['. $key .'][id]', $image['id'] ) }}--}}
                        {{--<img src="{{ $image['thumbnail'] }}" alt="{{ $image['alt'] }}" class="col-md-1 col-xs-2">--}}

                        <td>
                            <button class="btn btn-danger btn-img-product-form" type="button" onclick="$(this).closest('tr').remove();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                        </td>

                        {{--</div>--}}
                    </tr>
                @endforeach
            @endif

            @php
                isset($key) ? $key++ : $key = 0;
            @endphp

            <tr>
                {{--<div class="form-group form-row align-items-center imgKey">--}}
                <th>
                    {{ Form::radio('images_main', $key) }}
                </th>
                {{--{{ Form::label('images['. $key .'][file]', 'New image', array('class' => 'col-md-1 col-xs-2')) }}--}}
                {{--{{ Form::file('images['. $key .'][file]' ,array('id'=>'')) }}--}}

                <td>
                    <div class="img-product-form">
                        <img class="placeholder" src="" alt="">
                        {{--<input class="img-input" type="file" onchange="placeHolderImg(event)">--}}
                        {{ Form::file('images['. $key .'][file]' ,array('id'=>'', 'class' => 'img-input')) }}
                    </div>
                </td>

                {{--<label class="custom-file">--}}
                {{--{{ Form::file('images['. $key .'][file]' ,array('id'=>'', 'class' => 'custom-file-input', 'onclick' => 'nameImgProduct()')) }}--}}
                {{--<span class="custom-file-control"></span>--}}
                {{--</label>--}}
                <td>
                    {{--{{ Form::label('images['. $key .'][order]','Order') }}--}}
                    {{ Form::number('images['. $key .'][order]', 0, array('class' => 'form-control')) }}
                </td>

                <td>
                    <button class="btn btn-danger btn-img-product-form" type="button" onclick="$(this).closest('tr').remove();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                </td>

                {{--</div>--}}
            </tr>

            <tr>
                <td>
                    <button class="btn btn-primary btn-img-product-form" type="button" onclick="addNewImg()"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

    <div class="tab-pane fade" id="characteristics" role="tabpanel" aria-labelledby="characteristics-tab">

        <h1>Характеристики</h1>

        @if(!empty($features))
            @foreach($features as $key => $feature)

                @include('features.values.' . $feature->type, array(
                    "feature" => $feature,
                    "selectValue" => $product->featurePivot->where('feature_id', $feature->id),
                    "key" => $key
                ))

            @endforeach
        @endif

    </div>

    <div class="tab-pane fade" id="options" role="tabpanel" aria-labelledby="options-tab">
        <h1>Параметры</h1>
        <div class="form-group">
            {{ Form::label('properties[product_code]','Артикул') }}
            {{ Form::text('properties[product_code]', empty($product->product_code) ?'': $product->product_code, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('properties[amount]','Amount') }}
            {{ Form::number('properties[amount]', empty($product->amount) ?'': $product->amount, array('class'=>'form-control') )}}
        </div>
        <div class="form-group">
            {{ Form::label('properties[weight]','Weight') }}
            {{ Form::number('properties[weight]', empty($product->weight) ?'': $product->weight, array('class'=>'form-control') )}}
        </div>
        <div class="form-group">
            {{ Form::label('properties[length]','Length') }}
            {{ Form::number('properties[length]', empty($product->length) ?'': $product->length, array('class'=>'form-control') )}}
        </div>
        <div class="form-group">
            {{ Form::label('properties[width]','Width') }}
            {{ Form::number('properties[width]', empty($product->width) ?'': $product->width, array('class'=>'form-control') )}}
        </div>
        <div class="form-group">
            {{ Form::label('properties[height]','Height') }}
            {{ Form::number('properties[height]', empty($product->height) ?'': $product->height, array('class'=>'form-control') )}}
            {{--<br>--}}
            {{--{{ Form::label('properties[shipping_freight]','Shipping freight') }}--}}
            {{--{{ Form::number('properties[shipping_freight]', $product->shipping_freight) }}--}}

            {{--<br>--}}
            {{--{{ Form::label('properties[is_edp]','Is edp') }}--}}
            {{--{{ Form::radioChar('properties[is_edp]', ['Y', 'N'], $product->is_edp) }}--}}

        </div>
        <div class="form-group">
            {{ Form::label('properties[min_qty]','Min qty') }}
            {{ Form::number('properties[min_qty]', empty($product->min_qty) ?'': $product->min_qty, array('class'=>'form-control') )}}
        </div>
        <div class="form-group">
            {{ Form::label('properties[max_qty]','Max qty') }}
            {{ Form::number('properties[max_qty]', empty($product->max_qty) ?'': $product->max_qty, array('class'=>'form-control') )}}
        </div>
        <div class="form-group">
            {{ Form::label('properties[qty_step]','Qty step') }}
            {{ Form::number('properties[qty_step]', empty($product->qty_step) ?'': $product->qty_step, array('class'=>'form-control') )}}
        </div>
        <div class="form-group">
            {{ Form::label('properties[list_qty_count]','List qty count') }}
            {{ Form::number('properties[list_qty_count]', empty($product->list_qty_count) ?'': $product->list_qty_count, array('class'=>'form-control') )}}
            {{--<br>--}}
            {{--{{ Form::label('properties[shipping_params]','shipping params') }}--}}
            {{--{{ Form::number('properties[shipping_params]', $product->shipping_params) }}--}}
        </div>

    </div>

    <div class="tab-pane fade" id="cost" role="tabpanel" aria-labelledby="cost-tab">

        <h1>Цены</h1>
        <div class="form-group">
            {{ Form::label('prices[guest][price]','Цена') }}
            {{ Form::number('prices[guest][price]', empty($price->price) ?'': $price->price, array('class'=>'form-control') ) }}
        </div>

    </div>

</div>