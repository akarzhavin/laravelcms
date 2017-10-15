<div class="row">
    <div class="col-md-7 sort">
        <label>Сортировать</label>
        <div class="styled-select white rounded">
            <select onchange="location = this.value;">
                <option value="">По возрастанию цены</option>
                <option value="">По убыванию цены</option>
                <option value="">По новизне</option>
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <div id="search">
            <input name="search" type="text" placeholder="Поиск" onfocus="this.placeholder=''" onblur="this.placeholder='Поиск'" /><button type="button"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>

<div class="row">
    <hr>
    <div id="goods">
    @foreach ($products as $product)
        <div class="col-md-4 col-sm-6">
            <div class="product-layout">
                <div class="product-thumb transition">
                    <div class="image">
                        <div class="product-button-buy">
                            <button type="button" onclick="cart.add('{{ $product->id }}');">Добавить в корзину
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            </button>
                        </div>
                         @if(empty($product->images->first()))
                            <img src="{{ Images::placeholder() }}" alt="" title="" class="img-responsive">
                         @else
                            <img src="{{ $product->images->first()->original() }}" alt="" title="" class="img-responsive">
                         @endif

                    </div>
                    <div class="caption">
                        <h4><a href="/catalog/{{ $product->categories->first()->id_path }}/product/{{ $product->id }}">
                                {{ $product->description->title }}</a></h4>
                        <div class="price">
                            @if(!empty($product->prices->first()))
                                <div class="RecommendedPrice">
                                    Рекомендуемая цена: <span class="cost">{{ $product->prices->first()->price }}</span>
                                </div>
                                <div class="PriceHover">
                                <span class="cost">{{ $product->prices->first()->price }}</span>
                                <span class="price-tax">{{ $product->prices->first()->price }}</span>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    </div>
</div>
