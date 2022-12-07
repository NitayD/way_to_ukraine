<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

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
                    <div class="collapse navbar-collapse align-items-center" id="navbarTogglerDemo01">
                        <a class="navbar-brand d-inline-flex align-items-center" href="{{ route('main') }}">
                            <img src="{{ asset('images/logo.svg') }}" width="100" height="60" class="d-inline-block align-top" alt="">
                            <b>@lang('welcome.header')</b>
                        </a>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">@lang('welcome.about')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('team') }}">@lang('welcome.team')</a>
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
                    <div class="mx-3">
                        @lang('welcome.total_donation')<b>€ @convert(\App\Models\Fundraising::sum('already_collected'))</b>
                    </div>
                    <a href="{{ route('fundraisers') }}" class="bttn bttn-main">
                        <span>@lang('welcome.donate')</span>
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
            @yield("content")
        </main>

        <footer class="footer py-5">
            <div class="container-xxl">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <h5 class="title">Menu</h5>
                        <ul class="link-list">
                            <li>
                                <a href="{{ route('about') }}">О нас</a>
                            </li>
                            <li>
                                <a href="{{ route('team') }}">Команда</a>
                            </li>
                            <li>
                                <a href="{{ route('fundraisers') }}">Сборы</a>
                            </li>
                            <li>
                                <a href="{{ route('requisites') }}">Реквизиты</a>
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
                        <h5 class="title">Social media</h5>
                        <div class="social">
                            <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/facebook.png') }}" alt="">
                            </a>
                            <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/instagram.png') }}" alt="">
                            </a>
                            <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/linkedin.png') }}" alt="">
                            </a>
                            <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/whatsapp.png') }}" alt="">
                            </a>
                            <a href="" class="social-link">
                                <img class="img-fluid" src="{{ asset('/images/social/youtube.png') }}" alt="">
                            </a>
                        </div>
                        <h5 class="title">E-mail</h5>
                        <ul class="mail link-list">
                            <li>
                                <a href="mailto:test@test.test">
                                    <img src="{{ asset('/images/mail.png') }}" alt="">
                                    Основная почта: test@test.test
                                </a>
                            </li>
                            <li>
                                <a href="mailto:test@test.test">
                                    <img src="{{ asset('/images/mail.png') }}" alt="">
                                    Запасная почта: test@test.test
                                </a>
                            </li>
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
