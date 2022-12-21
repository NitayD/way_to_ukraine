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
            'name' => 'LoremN',
            'last_name' => 'LoremSN',
            'position' => 'Developer',
            'image' => '/images/person.png'
        ],
        [
            'name' => 'LoremN',
            'last_name' => 'LoremSN',
            'position' => 'Developer',
            'image' => '/images/person.png'
        ],
        [
            'name' => 'LoremN',
            'last_name' => 'LoremSN',
            'position' => 'Developer',
            'image' => '/images/person.png'
        ],
        [
            'name' => 'LoremN',
            'last_name' => 'LoremSN',
            'position' => 'Developer',
            'image' => '/images/person.png'
        ],
    ]);
    $partn = collect([
        [
            'name' => 'Анастасія',
            'last_name' => 'Савчишин',
            'position' => 'Краудфандінг коштів під потреби фонду',
            'image' => '/images/team/1.jpg'
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
                            <h3 class="text-center mt-auto">{{ $item['last_name'] }} {{ $item['name'] }}</h3>
                            <i>{{ $item['position'] }}</i>
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


