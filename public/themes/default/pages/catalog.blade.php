@extends('layouts.main')
@section('content')
    @include('includes.header')
    <div id="section-2"></div>
    <div id="section-3">
        <div class="container">
            <div class="row">

                @include('partials._filters-catalog')

                <div class="col-md-9">
                    @include('partials._sortby-catalog')
                    @include('partials._product-list')
                    @include('partials._pagination-catalog')
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')

@stop