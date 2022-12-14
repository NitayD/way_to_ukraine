@extends('layouts.default', [
    'breadcrumbs' => [
        [
            'text' => trans('welcome.main.title'),
            'link' => route('main'),
        ],
        [
            'text' => trans('welcome.about'),
        ],
    ]
])

@php
    $team = collect([
        [
            'name' => 'Сергій',
            'last_name' => 'Мельников',
            'position' => 'Голова фонду',
            'image' => '/images/team/serg.jpg',
            'social' => [
                'telegram' => 'https://t.me/melnykov1508'
            ]
        ],
        [
            'name' => 'Тимофій',
            'last_name' => 'Постоюк',
            'position' => 'Менеджер з розвитку фонду',
            'image' => '/images/team/tymo.jpg',
            'social' => [
                'telegram' => 'https://t.me/CU4O2'
            ]
        ],
        [
            'name' => 'Карина',
            'last_name' => 'Шуба',
            'position' => 'PR-менеджер',
            'image' => '/images/team/karina.jpg'
        ],
        [
            'name' => 'Богдан',
            'last_name' => 'Жук',
            'position' => 'Головний спеціаліст з обслуговування авто',
            'image' => '/images/team/zhuk.jpg'
        ],
        [
            'name' => 'Максим',
            'last_name' => 'Гладкіх',
            'position' => 'Спеціаліст з обслуговування авто\Водій',
            'image' => '/images/team/max.jpg'
        ],
        [
            'name' => 'Володимир',
            'last_name' => 'Тележинський',
            'position' => 'Головний механік',
            'image' => '/images/team/volodimir.jpg'
        ],
        [
            'name' => 'Глєб',
            'last_name' => 'Дерікот',
            'position' => 'Спеціаліст з обслуговування авто\Водій',
            'image' => '/images/team/gleb.jpg'
        ],
        [
            'name' => 'Нітай',
            'last_name' => 'Джаксібаєв',
            'position' => 'Розробник вебсайту',
            'image' => '/images/team/nitay.jpg',
            'social' => [
                'telegram' => 'https://t.me/id294735285'
            ]
        ],
    ]);
    $partn = collect([
        [
            'name' => 'Анастасія',
            'last_name' => 'Савчишин',
            'position' => 'Краудфандінг коштів під потреби фонду',
            'image' => '/images/team/anastasiya.jpg',
            'social' => [
                'twitter' => 'https://twitter.com/asvchy'
            ]
        ],
    ]);
@endphp

@section('content')
    <article class="container-fluid second mt-3">
        <h2 class="text-center mb-4">@lang('welcome.team')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @foreach ($team as $item)
                    <div class="col-12 col-md-4 my-3">
                        <div class="block block-secondary text-center">
                            @if (!empty($item['image']))
                                <figure><img src="{{asset($item['image'])}}" alt=""></figure>
                            @endif
                            <h4 class="mt-auto">
                                <b>{{ $item['last_name'] }} {{ $item['name'] }}</b>
                            </h4>
                            <span>{{ $item['position'] }}</span>
                            <div class="social mt-2">
                                @if (!empty($item['social']))
                                    @foreach ($item['social'] as $social => $link)
                                        <a href="{{$link}}" class="social-link social-link--invert" target="_blank">
                                            <img class="img-fluid" src="{{ asset('/images/social/'.$social.'.png') }}" alt="">
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>
    <article class="container-fluid second mt-3">
        <h2 class="text-center mb-4">@lang('welcome.partners')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @foreach ($partn as $item)
                    <div class="col-12 col-md-4 my-3">
                        <div class="block block-secondary text-center">
                            @if (!empty($item['image']))
                                <figure><img src="{{asset($item['image'])}}" alt=""></figure>
                            @endif
                            <h4 class="mt-auto">
                                <b>{{ $item['last_name'] }} {{ $item['name'] }}</b>
                            </h4>
                            <span>{{ $item['position'] }}</span>
                            <div class="social mt-2">
                                @if (!empty($item['social']))
                                    @foreach ($item['social'] as $social => $link)
                                        <a href="{{$link}}" class="social-link social-link--invert" target="_blank">
                                            <img class="img-fluid" src="{{ asset('/images/social/'.$social.'.png') }}" alt="">
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

@endsection


