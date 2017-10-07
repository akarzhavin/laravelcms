@if(!empty($filter->feature->values))
    <button data-toggle="collapse" type="button" data-target="#filter_{{ $key }}" class="collapsed">
        {{ $filter->title }} <i class="fa fa-angle-down" aria-hidden="true" ></i>
    </button>
    <div id="filter_{{ $key }}" class="collapse">
        <ul>
            @foreach($filter->feature->values as $value)
                <li><input type="checkbox" name="filter[f_{{$key}}][]" value="{{ $value->id }}"> {{ $value->value }}</li>
            @endforeach
        </ul>
    </div>
@endif