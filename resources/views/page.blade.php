@extends('layouts.default')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
@endpush
@push('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('slick.min.js') }}"></script>
    <script>
        $(function () {
            $('.mnn-slider').slick({
                lazyLoad: 'ondemand',
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                fade: true,
                asNavFor: '.mnn-slider-mini'
            });
            $('.mnn-slider-mini').slick({
                lazyLoad: 'ondemand',
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                fade: true,
                asNavFor: '.mnn-slider',
                slidesToScroll: 1,
                centerMode: true,
                focusOnSelect: true
            });
        })
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-md-7 p-3">
            {!! $page->page_text !!}
        </div>
        <div class="col-12 col-md-5 p-3">
            <div class="mnn-slider">
                @foreach ($page->images as $item)
                    <img src="{{ $item->getUrl() }}" alt="">
                @endforeach
            </div>
            <div class="mnn-slider-mini">
                @foreach ($page->images as $item)
                    <img src="{{ $item->getUrl() }}" alt="">
                @endforeach
            </div>
        </div>
    </div>
@endsection
