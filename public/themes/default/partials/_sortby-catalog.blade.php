<div class="row">
    <div class="col-md-6 sort">
        <label>Сортировать по</label>
        <div class="styled-select white rounded">
            <select onchange="location = this.value;">
                <option value="">По возрастанию цены</option>
                <option value="">По убыванию цены</option>
                <option value="">По новизне</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div id="search">
            {{ Form::open(array('action'=>'ShopController@search')) }}
                <input type="hidden" name="search_query" value="all" id="search_query">
                <input type="text" class="form-control" name="q" placeholder="Search">
                <span style="display: inherit" class="input-group-btn"></span>
                {{ Form::button('<span class="glyphicon glyphicon-search"></span>', array('type' => 'submit', 'class' => 'btn btn-default sbutton', 'id'=>'searchButton')) }}
            {{ Form::close() }}
                    {{--<input name="search" type="text" placeholder="Поиск" onfocus="this.placeholder=''" onblur="this.placeholder='Поиск'" /><button type="button"><i class="fa fa-search"></i></button>--}}
        </div>
    </div>
</div>