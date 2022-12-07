@extends('layouts.default')

@section('content')

    <article class="first">
        <div class="container-fluid h-100">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="first--hello">
                    <h1 class="first--header">
                        @lang('welcome.header')
                    </h1>
                    <h3 class="first--subheader">
                        @lang('welcome.subheader')
                    </h3>
                    <a href="{{ route('fundraisers') }}" class="first--bttn bttn bttn-main bttn-big mt-3">
                        <span>@lang('welcome.donate')</span>
                    </a>
                </div>
            </div>
        </div>
    </article>

    <article class="container-fluid">
        <h2 class="mb-4">@lang('welcome.how_we_work')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="fund fund-card fund-main">
                        <h3>Ми збираємо для вас гроші</h3>
                        <p class="text-justify">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, labore.
                        </p>
                        <ul>
                            <li>Lorem, ipsum dolor.</li>
                            <li>Lorem, ipsum dolor.</li>
                            <li>Lorem, ipsum dolor.</li>
                            <li>Lorem, ipsum dolor.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="fund fund-card">
                        <h3>Ви приходьте зі своїми грошима</h3>
                        <p class="text-justify">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea nihil magni numquam.
                        </p>
                        <ul>
                            <li>Lorem, ipsum dolor.</li>
                            <li>Lorem, ipsum dolor.</li>
                            <li>Lorem, ipsum dolor.</li>
                            <li>Lorem, ipsum dolor.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article class="container-fluid p-5 second">
        <h2 class="text-center mb-4">Актуальные сборы</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @foreach ($funds as $item)
                    <div class="col-12 col-md-4 my-3">
                        <div class="fund fund-card h-100">
                            <div class="fund--title">
                                {{$item->title}}
                            </div>
                            <div class="fund--desc">
                                {{$item->description_short}}
                            </div>
                            <div class="mt-auto"></div>
                            @if (!empty($item->funraising_purchasing_lists_sum_total_sum))
                                <div class="fund--progress">
                                    <div class="fund--progress_ints">
                                        <span>€ @convert($item->already_collected)</span>
                                        <span>/</span>
                                        <span>€ @convert($item->funraising_purchasing_lists_sum_total_sum)</span>
                                    </div>
                                    <div data-progress="{{$item->progress}}"></div>
                                </div>
                            @else
                                <div class="fund--progress_ints">
                                    Уже собрано: <span>€ @convert($item->already_collected)</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('fundraising', [
                                    'fundraising' => $item->id
                                ]) }}" class="bttn bttn-white">
                                    <span>
                                        Сбор на банку
                                    </span>
                                </a>
                                <a href="{{ route('fundraising', [
                                    'fundraising' => $item->id
                                ]) }}" class="bttn">
                                    <span>
                                        Детали
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('fundraisers') }}" class="bttn bttn-big mt-5 more">@lang('welcome.more')</a>
        </div>
    </article>

    @foreach ($blocks as $item)
        <article class="container-fluid px-5">
            <h2 class="text-center mb-4">
                {{$item->name}}
            </h2>
            <div class="container-xxl">
                <div class="row justify-content-center">
                    @foreach ($item->pages as $page)
                        <div class="col-12 col-md-4 my-3">
                            <div class="fund fund-card {{!empty($page->featured_image) ? 'fund-image': '' }} h-100" style="background-image: url({{!empty($page->featured_image) ? asset($page->featured_image->getUrl()): ''}});">
                                <div class="fund--title">
                                    {{$page->title}}
                                </div>
                                <div class="fund--desc my-3">
                                    {{$page->excerpt}}
                                </div>
                                <div class="mt-auto"></div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('page', [
                                        'page' => $page->id
                                    ]) }}" class="bttn">
                                        <span>
                                            Детали
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('category', [
                    'category' => $item->id
                ]) }}" class="bttn bttn-big mt-5 more">@lang('welcome.more')</a>
            </div>
        </article>
    @endforeach




    <article class="container-fluid px-5 second">
        <h2 class="text-center mb-4">@lang('welcome.reqs')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @foreach ($reqs as $item)
                    <div class="col-12 col-lg-6 my-3">
                        <div class="fund">
                            <h3 class="text-center">{{ $item->name }}</h3>
                            @foreach ($item->groupRequisites as $req)
                                <p>
                                    <h5>{{ $req->label }}</h5>
                                    <span class="copy">{{ $req->value }}</span>
                                </p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('requisites') }}" class="bttn bttn-big mt-5 more">@lang('welcome.more')</a>
        </div>
    </article>

@endsection

@push('scripts')
    <script src="{{ asset('/js/probar.js') }}"></script>
    <script>
        $(function () {
            let barCouner = 0;
            $('.fund--progress [data-progress]').each(function (ind) {
                let bar = new ProBar({
                    color: "#004491",
                    bgColor: "#FFF3B3",
                    speed: 0.6,
                    wrapper: this,
                    wrapperId: 'bar' + ind,
                    height: 40,
                    finishAnimation: true,
                    rounded: {
                        topLeft: 10,
                        topRight: 10,
                        bottomLeft: 10,
                        bottomRight: 10,
                    }
                });
                bar.goto($(this).data('progress'))
            })
        })
    </script>
@endpush
