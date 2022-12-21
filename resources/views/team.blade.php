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
            'image' => '/images/team/serg.jpg'
        ],
        [
            'name' => 'Тимофій',
            'last_name' => 'Постоюк',
            'position' => 'Менеджер з розвитку фонду',
            'image' => '/images/team/tymo.jpg'
        ],
        [
            'name' => 'Богдан',
            'last_name' => 'Жук',
            'position' => 'Головний маляр',
            'image' => '/images/team/zhuk.jpg'
        ],
        [
            'name' => 'Максим',
            'last_name' => 'Гладкіх',
            'position' => 'Маляр та водій',
            'image' => '/images/team/max.jpg'
        ],
        [
            'name' => 'Володимир',
            'last_name' => 'Тележинський',
            'position' => 'Механік',
            'image' => '/images/team/volodimir.jpg'
        ],
        [
            'name' => 'Карина',
            'last_name' => 'Шуба',
            'position' => 'PR-менеджер',
            'image' => '/images/team/karina.jpg'
        ],
        [
            'name' => 'Нитай',
            'last_name' => 'Джаксибаев',
            'position' => 'Розробник вебсайту',
            'image' => '/images/team/nitay.jpg'
        ],
    ]);
    $partn = collect([
        [
            'name' => 'Анастасія',
            'last_name' => 'Савчишин',
            'position' => 'Краудфандінг коштів під потреби фонду',
            'image' => '/images/team/anastasiya.jpg'
        ],
    ]);
@endphp

@section('content')
    <article class="container-fluid px-5 second mt-3">
        <h2 class="text-center mb-4">@lang('welcome.team')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @foreach ($team as $item)
                    <div class="col-6 col-md-4 my-3">
                        <div class="block block-secondary">
                            @if (!empty($item['image']))
                                <figure><img src="{{asset($item['image'])}}" alt=""></figure>
                            @endif
                            <h4 class="text-center mt-auto">
                                <b>{{ $item['last_name'] }} {{ $item['name'] }}</b>
                            </h4>
                            <span>{{ $item['position'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>
    <article class="container-fluid px-5 second mt-3">
        <h2 class="text-center mb-4">@lang('welcome.partners')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @foreach ($partn as $item)
                    <div class="col-6 col-md-4 my-3">
                        <div class="block block-secondary">
                            @if (!empty($item['image']))
                                <figure><img src="{{asset($item['image'])}}" alt=""></figure>
                            @endif
                            <h4 class="text-center mt-auto">
                                <b>{{ $item['last_name'] }} {{ $item['name'] }}</b>
                            </h4>
                            <span>{{ $item['position'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

@endsection


