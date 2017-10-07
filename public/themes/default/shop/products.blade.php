@extends('layouts.main')
@section('content')

    <style>
        .btn-product{
            width: 100%;
        }
    </style>

    @include('includes.header')

    <div id="section-2"></div>5

    <div id="section-3">
        <div class="container">
            <div class="row">
                <div class="col-md-3 filter">
                    @include('partials._filters-catalog')
                </div>
                <div class="col-md-9">
                    @include('partials._product-list')
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>


@stop