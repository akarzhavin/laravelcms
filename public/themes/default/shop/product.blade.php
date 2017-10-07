@extends('layouts.main')
@section('content')

    @include('includes.header')
    <div id="section-full">
        <div class="container">
            <div class="row row-flex">
                <div class="col-md-6 slider">

                    {{--@if(!($product->image_name=="" || $product->image_name=="sample_file_123.png"))--}}
                        {{--<img id="img_gall_1" src="/uploads/{{ $product->image_name }}" --}}
                             {{--data-zoom-image="/uploads/{{ $product->image_name }}"/>--}}
                    {{--@else--}}

                        {{--<img src="http://placehold.it/650x450&text=Image Not Uploaded"--}}
                             {{--id="img_gall_1">--}}
                    {{--@endif--}}

                    <div id="gallery_01">
                        @foreach($product->images as $image)
                            <img src="{{ $image->original() }}"
                                     alt="" title="" class="img-responsive">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 content-text">
                    <h4>{{ $product->description->name }}</h4>
                    @foreach($product->featureValues as $featureValue)
                        @php
                            $value_id = $featureValue->id;
                        @endphp
                    <b>{{ $featureValue->feature->description->title }}:</b>  {{ $featureValue->value }} <br><br>
                    @endforeach
                    <b>{{ $product->description->full_description }}</b>
                    <div class="full-price">
                        Цена: <span class="cost">{{ $product->price }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')

    {{--@if($product->stock>0)--}}

@stop