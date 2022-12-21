<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('welcome.meta.title')</title>
    <meta name="title" content="@lang('welcome.meta.title')">
    <meta name="description" content="@lang('welcome.meta.description')">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{config('app.url')}}">
    <meta property="og:title" content="@lang('welcome.meta.title')">
    <meta property="og:description" content="@lang('welcome.meta.description')">
    <meta property="og:image" content="{{ asset('/images/main_bg4.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{config('app.url')}}">
    <meta property="twitter:title" content="@lang('welcome.meta.title')">
    <meta property="twitter:description" content="@lang('welcome.meta.description')">
    <meta property="twitter:image" content="{{ asset('/images/main_bg4.jpg') }}">

    @stack('styles')
</head>

<body>

    <main class="page">

        <header class="header">
            <div class="container-xxl">
                <nav class="navbar navbar-dark navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse align-items-center">
                        <a class="d-inline-flex align-items-center header__logo" href="{{ route('main') }}">
                            <img src="{{ asset('images/logo.svg') }}" width="100" height="60" class="d-inline-block align-top" alt="">
                            <b>@lang('welcome.main.header')</b>
                        </a>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">@lang('welcome.about')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('team') }}">@lang('welcome.team')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('fundraisers') }}">@lang('welcome.donation.title')</a>
                            </li>

                            @php
                                $categories = \App\Models\ContentCategory::all();
                            @endphp
                            @foreach ($categories as $item)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('category', [
                                        'category' => $item->id
                                    ]) }}">{{$item->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('fundraisers') }}" class="bttn bttn-secondary">
                        <span>@lang('welcome.donate.btn')</span>
                    </a>
                    {{-- <nav class="nav">
                        <a class="nav-link {{ app()->isLocale('ua') ? 'disabled' : 'text-white' }}" href="{{ url()->current() }}?change_language=ua">
                            <u>UA</u>
                        </a>
                        <a class="nav-link {{ app()->isLocale('en') ? 'disabled' : 'text-white' }}" href="{{ url()->current() }}?change_language=en">
                            <u>EN</u>
                        </a>
                    </nav> --}}
                </nav>
            </div>
        </header>

        <main>
            @if (!empty($breadcrumbs))
                <div class="container-xxl mt-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @foreach ($breadcrumbs as $item)
                                @if (!empty($item['link']))
                                    <li class="breadcrumb-item">
                                        <a href="{{ $item['link'] }}">
                                            {{ $item['text'] }}
                                        </a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $item['text'] }}
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
            @endif
            @yield("content")
        </main>

        <footer class="footer py-5">
            <div class="container-xxl">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <h5 class="title">@lang('welcome.footer.menu')</h5>
                        <ul class="link-list">
                            <li>
                                <a href="{{ route('about') }}">@lang('welcome.about')</a>
                            </li>
                            <li>
                                <a href="{{ route('team') }}">@lang('welcome.team')</a>
                            </li>
                            <li>
                                <a href="{{ route('fundraisers') }}">@lang('welcome.donation.title')</a>
                            </li>
                            <li>
                                <a href="{{ route('requisites') }}">@lang('welcome.reqs')</a>
                            </li>
                            @php
                                $cats = \App\Models\ContentCategory::all();
                            @endphp
                            @foreach ($cats as $item)
                                <li>
                                    <a href="{{ route('category', [
                                        'category' => $item->id
                                    ]) }}">{{$item->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-md-6">
                        <h5 class="title">@lang('welcome.footer.social')</h5>
                        <div class="social">
                            <a href="https://www.facebook.com/groups/way.to.ukraine" class="social-link" target="_blank">
                                <img class="img-fluid" src="{{ asset('/images/social/facebook.png') }}" alt="">
                            </a>
                            <a href="https://www.instagram.com/way.to.ukraine/" class="social-link" target="_blank">
                                <img class="img-fluid" src="{{ asset('/images/social/instagram.png') }}" alt="">
                            </a>
                            {{-- <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/linkedin.png') }}" alt="">
                            </a>
                            <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/whatsapp.png') }}" alt="">
                            </a>
                            <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/youtube.png') }}" alt="">
                            </a> --}}
                        </div>
                        <h5 class="title">@lang('welcome.footer.email')</h5>
                        <ul class="mail link-list">
                            <li>
                                <a href="mailto:melnykov_sergiy@ukr.net" target="_blank">
                                    <img src="{{ asset('/images/mail.png') }}" alt="">
                                    Основна поштова скринька: <b> melnykov_sergiy@ukr.net</b>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/melnykov1508" target="_blank">
                                    <img src="{{ asset('/images/social/telegram.png') }}" alt="">
                                    Передача авто\Робота фонду: <b> @melnykov1508</b>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/CU4O2" target="_blank">
                                    <img src="{{ asset('/images/social/telegram.png') }}" alt="">
                                    Партнерство\Спонсорство: <b> @CU4O2</b>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="mailto:test@test.test">
                                    <img src="{{ asset('/images/mail.png') }}" alt="">
                                    Запасная почта: test@test.test
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </main>

    @stack('scripts')
    <script src="{{ asset('/js/notify.min.js') }}"></script>
    <script>
        $(function () {
            function copyToClipboard(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(element).text().trim()).select();
                document.execCommand("copy");
                $temp.remove();
                $.notify("@lang('welcome.copied')", "success");
            }
            $('.copy').on('click', function (e) {
                copyToClipboard(e.target)
            })
        })
    </script>
</body>

</html>
