<h4>КАТАЛОГ</h4>
<form action="{{ url()->current() }}" method="POST">
    {{ csrf_field() }}
    <button>Сбросить всё</button>
    <div class="filter-item">
        @foreach($filters as $key => $filter)
            @include('filters.'. $filter->type)
        @endforeach
    </div>
    {{--{{ Form::submit('Filter') }}--}}
    <button type="submit">Фильтровать</button>
</form>
