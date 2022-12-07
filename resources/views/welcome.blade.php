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

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
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
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon" class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="underline">Telescope</a>, and more.
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="col-6 col-md-4 my-3">
                        <div class="fund">
                            <h3 class="text-center">{{ $item->name }}</h3>
                            <table class="w-100">
                                <tbody>
                                    @foreach ($item->groupRequisites as $req)
                                        <tr>
                                            <th class="p-2">{{ $req->label }}</th>
                                            <td class="p-2 text-end copy">{{ $req->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
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
