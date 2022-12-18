@extends('layouts.default', [
    'breadcrumbs' => array_merge(
        [
            [
                'text' => trans('welcome.main.title'),
                'link' => route('main'),
            ],
        ],
        $data->categories()->count() > 0
            ? $data->categories->map(function ($item) {
                return [
                    'text' => $item->name,
                    'link' => route('category', [
                        'category' => $item->id
                    ]),
                ];
            })->toArray()
            : [],
        [
            [
                'text' => $data->title,
            ],
        ]
    )
])

@php
    $content = explode('[[SLIDER]]', $data->page_text);
@endphp

@section('content')
    <article class="mt-3">
        <div class="container-xxl">
            <div class="d-flex align-items-start flex-column">
                <h1 class="text-uppercase">{{ $data->title }}</h1>
                <i>{{ $data->created_at->format('d-m-Y') }}</i>
            </div>
            <div class="html-content mt-3">
                @foreach ($content as $chunk)
                    {!! $chunk !!}
                    @if (!$loop->last)
                    <div class="px-4">
                        <div class="slider">
                            @foreach ($data->images as $photo)
                                <img src="{{ $photo->preview }}" data-lazy="{{ $photo->url }}" alt="">
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endforeach
                @if (count($content) < 2)
                <div class="px-4">
                    <div class="slider">
                        @foreach ($data->images as $photo)
                            <img src="{{ $photo->preview }}" data-lazy="{{ $photo->url }}" alt="">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </article>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css') }}"/>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(function () {
            $('.slider').slick({
                lazyLoad: 'progressive',
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                arrows: false,
                autoplay: false,
                adaptiveHeight: true,
                dots: true,
            });
            $('.item-gallary').slick({
                lazyLoad: 'progressive',
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
            });
            $('.slider--items').slick({
                lazyLoad: 'progressive',
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                arrows: true,
                autoplay: false,
                dots: false,
            })
            $('.slider--mini').slick({
                lazyLoad: 'progressive',
                slidesToShow: 1,
                arrows: false,
                autoplay: true,
                dots: false,
            })
            $('[data-bs-toggle]').on('click', function () {
                $('.item-gallary').slick('reinit')
            })
        })
    </script>
@endpush
