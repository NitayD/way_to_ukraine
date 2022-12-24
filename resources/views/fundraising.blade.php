@extends('layouts.default', [
    'breadcrumbs' => [
        [
            'text' => trans('welcome.main.title'),
            'link' => route('main'),
        ],
        [
            'text' => trans('welcome.donation.title'),
            'link' => route('fundraisers'),
        ],
        [
            'text' => $data->title,
        ],
    ]
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
                    <div>
                        {!! $data->description !!}
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="px-3">
                        <div class="fundlist__content mb-4">
                            <div class="row justify-content-center">
                                <div class="col d-flex flex-column @if ($data->itemsSum == 0) text-center @endif">
                                    <span class="text-white">@lang('welcome.donate.collected')</span>
                                    ₴ @convert($data->already_collected)
                                </div>
                                @if ($data->itemsSum > 0 && ($data->itemsSum - $data->already_collected) > 0)
                                    <div class="col text-end d-flex flex-column">
                                        <span class="text-white">@lang('welcome.donate.left')</span>
                                        <b>₴ @convert($data->itemsSum - $data->already_collected)</b>
                                    </div>
                                @endif
                            </div>
                            @if ($data->itemsSum > 0)
                                <div class="fundlist__progress">
                                    {{$data->progress}}%
                                    <div class="fundlist__progress--bar"><span style="width: {{$data->progress}}%;"></span></div>
                                </div>
                            @endif
                        </div>
                        <div class="my-4">
                            <a href="{{ $data->donation_link }}" target="_blank" class="bttn bttn-secondary d-block text-center">
                                @lang('welcome.donate.link')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @if ($data->funraisingPurchasingLists()->count() > 0)
                <div class="my-5">
                    <div class="slider--items" id="items">
                        @foreach ($data->funraisingPurchasingLists()->with('item')->get() as $item)
                            <div class="block block-secondary">
                                @if ($item->item->photo->count())
                                    <figure class="slider--mini">
                                        @foreach ($item->item->photo as $photo)
                                            <img src="{{asset($photo->getUrl('preview'))}}" alt="">
                                        @endforeach
                                    </figure>
                                @endif
                                <b>{{$item->item->name}}</b>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fundlist mt-5">
                    <table>
                        <thead class="text-white">
                            <tr class="text-center">
                                <th>@lang('welcome.donate.table.name')</th>
                                <th>@lang('welcome.donate.table.amount')</th>
                                <th>@lang('welcome.donate.table.sum')</th>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->funraisingPurchasingLists()->with('item')->get() as $item)
                                <tr>
                                    <th>{{$item->item->name}}</th>
                                    <td>
                                        {{$item->amount}}
                                    </td>
                                    <th>
                                        ₴ @convert($item->total_sum)
                                    </th>
                                </tr>
                                <tr class="description text-white text-justify">
                                    <td colspan="3">
                                        {{ $item->item->description_short }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="slider mt-5 html-content">
                @foreach ($data->gallary as $photo)
                    <img src="{{ $photo->url }}" alt="">
                @endforeach
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
                arrows: true,
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
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
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
