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

@section('content')
    <article class="mt-3">
        <div class="container-xxl">
            <div class="d-flex align-items-start flex-column">
                <h1 class="text-uppercase">{{ $data->title }}</h1>
                <i>{{ $data->created_at->format('d-m-Y') }}</i>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-8">
                    <div class="html-content">
                        {!! $data->page_text !!}
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="px-3">
                        <div class="slider">
                            @foreach ($data->images as $photo)
                                <img src="{{ $photo->url }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
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
                lazyLoad: 'ondemand',
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                arrows: false,
                autoplay: false,
                adaptiveHeight: true,
                dots: true,
            });
            $('.item-gallary').slick({
                lazyLoad: 'ondemand',
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
            });
            $('.slider--items').slick({
                lazyLoad: 'ondemand',
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                arrows: true,
                autoplay: false,
                dots: false,
            })
            $('.slider--mini').slick({
                lazyLoad: 'ondemand',
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
