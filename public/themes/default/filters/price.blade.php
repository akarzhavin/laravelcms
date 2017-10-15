@if(!empty($filter))
    {{ $filter->title }}
    <div>
        <input type="number" style="width: 100%;" name="filter[p_min]" value="0">
        <br>
        <input type="number" style="width: 100%;" name="filter[p_max]" value="9999999">
    </div>
@endif