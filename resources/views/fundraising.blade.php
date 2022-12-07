@extends('layouts.default')

@section('content')
    <article class="container-fluid">
        <div class="mt-5"></div>
        <h2 class="mb-4">{{ $data->title }}</h2>
        <div class="container-xxl">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="px-2">
                        <div class="slider">
                            @foreach ($data->gallary as $photo)
                                <img src="{{ $photo->url }}" alt="">
                            @endforeach
                        </div>
                        @if ($data->itemsSum > 0)
                            <div class="pt-3">
                                <div class="fundlist__content mt-4 text-center">
                                    <h4>Осталось собрать: <b>€ @convert($data->itemsSum - $data->already_collected)</b></h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="fundlist__content">
                        {!! $data->description !!}
                    </div>
                    @if ($data->funraisingPurchasingLists()->count() > 0)
                        <div class="fundlist mt-5">
                            <table>
                                <thead>
                                    <tr class="text-center">
                                        <th>Наименование</th>
                                        <th>Количество</th>
                                        <th>Общая сумма</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->funraisingPurchasingLists()->with('item')->get() as $item)
                                    <tr>
                                        <th>
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample{{$item->item->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$item->item->id}}">
                                                {{$item->item->name}}
                                            </a>
                                        </th>
                                        <td>
                                            {{$item->amount}}
                                        </td>
                                        <td>
                                            € @convert($item->total_sum)
                                        </td>
                                    </tr>
                                    <tr class="description">
                                        <td colspan="3">
                                            <div class="collapse px-4" id="collapseExample{{$item->item->id}}">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="px-4">
                                                            <div class="item-gallary mb-3">
                                                                @foreach ($item->item->photo as $image)
                                                                    <img src="{{ $image->url }}" alt="">
                                                                @endforeach
                                                            </div>
                                                            {{ $item->item->description_short }}
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        {!! $item->item->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
                autoplay: true,
                adaptiveHeight: true,
                dots: true,
            });
            $('.item-gallary').slick({
                lazyLoad: 'ondemand',
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
            });
            $('[data-bs-toggle]').on('click', function () {
                $('.item-gallary').slick('reinit')
            })
        })
    </script>
@endpush
