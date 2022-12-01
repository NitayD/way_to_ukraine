<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body class="bg-dark text-white">

    <main class="page">

        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse align-items-center" id="navbarTogglerDemo01">
                    <a class="navbar-brand d-inline-flex align-items-center" href="{{ route('main') }}">
                        <img src="{{ asset('images/logo.svg') }}" width="100" height="60" class="d-inline-block align-top" alt="">
                        Way to Ukraine
                    </a>
                    <ul class="navbar-nav mr-auto">
                        @php
                            $categories = \App\Models\ContentCategory::all();
                        @endphp
                        @foreach ($categories as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="">{{$item->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <a href="" class="bttn bttn-main">
                    <span>
                        Задонатить
                    </span>
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
        </header>

        <main>
            @yield("content")
        </main>

        <footer>
            <div class="container-fluid">

            </div>
        </footer>

    </main>

    @stack('scripts')
</body>

</html>
