@extends('layouts.default')

@section('content')

    <article class="first">
        <div class="container-fluid h-100">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="first--hello">
                    <h1 class="first--header">
                        WAY TO UKRAINE
                    </h1>
                    <h3 class="first--subheader">
                        Фонд помощи ВСУ
                    </h3>
                    <a href="" class="first--bttn bttn bttn-main bttn-big mt-3">
                        <span>Задонатить</span>
                    </a>
                </div>
            </div>
        </div>
    </article>

    <article class="container-fluid">
        <h2 class="mb-4">Как мы работаем</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">
                <div class="fund fund-card fund-main">
                    <h3>Мы собираем для вас деньги</h3>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, labore.
                    </p>
                    <ul>
                        <li>Мы кушаем</li>
                        <li>Вы кушаете</li>
                        <li>Мы кушаем</li>
                        <li>Они кушают</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="fund fund-card">
                    <h3>Вы приходите со своими деньгами</h3>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea nihil magni numquam.
                    </p>
                    <ul>
                        <li>Мы кушаем</li>
                        <li>Вы кушаете</li>
                        <li>Мы кушаем</li>
                        <li>Они кушают</li>
                    </ul>
                </div>
            </div>
        </div>
    </article>

    <article class="container-fluid p-5 second">
        <h2 class="text-center mb-4">Актуальные сборы</h2>
        <div class="row">
            @foreach ($funds as $item)
                <div class="col-12 col-md-4">
                    <div class="fund fund-card fund-main h-100">
                        <div class="fund--title">
                            {{$item->title}}
                        </div>
                        <div class="fund--desc">
                            {{$item->description_short}}
                        </div>
                        @if (!empty($item->funraising_purchasing_lists_sum_total_sum))
                            <div class="fund--progress">
                                <div class="fund--progress_ints">
                                    <span>@convert($item->already_collected)</span>
                                    <span>/</span>
                                    <span>@convert($item->funraising_purchasing_lists_sum_total_sum)</span>
                                </div>
                                <div data-progress="{{$item->progress}}"></div>
                            </div>
                        @else
                            <div class="fund--progress_ints">
                                <span>@convert($item->already_collected)</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-end">
                            <a href="" class="bttn bttn-white">
                                <span>
                                    Детали
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </article>

    @foreach ($blocks as $item)
        <article class="container-fluid px-5">
            <h2 class="text-center mb-4">
                {{$item->name}}
            </h2>
            <div class="row justify-content-center">
                @foreach ($item->pages as $page)
                    <div class="col-12 col-md-4">
                        <div class="fund fund-card {{!empty($page->featured_image) ? 'fund-image' : '' }} h-100" style="background-image: url({{!empty($page->featured_image) ? asset($page->featured_image->getUrl()) : ''}});">
                            <div class="fund--title">
                                {{$page->title}}
                            </div>
                            <div class="fund--desc my-3">
                                {{$page->excerpt}}
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="" class="bttn">
                                    <span>
                                        Детали
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </article>
    @endforeach




    <article class="container-fluid px-5 second">
        <h2 class="text-center mb-4">Реквизиты</h2>
        <div class="row justify-content-center">
            @foreach ($reqs as $item)
                <div class="col-6 col-md-4">
                    <div class="fund">
                        <h3 class="text-center">{{ $item->name }}</h3>
                        <table class="w-100">
                            <tbody>
                                @foreach ($item->groupRequisites as $req)
                                    <tr>
                                        <th class="p-2">{{ $req->label }}</th>
                                        <td class="p-2 text-right">{{ $req->value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </article>

@endsection

@push('scripts')
    <script src="{{ asset('/js/probar.js') }}"></script>
    <script>
        $(function () {

            $('.fund--progress [data-progress]').each(function () {
                var probar = new ProBar({
                    color : "#0057b8",
                    bgColor : "white",
                    speed : 0.6,
                    wrapper: this,
                    height: 40,
                    finishAnimation: true,
                });
                probar.goto($(this).data('progress'))
            })

        })
    </script>
@endpush

