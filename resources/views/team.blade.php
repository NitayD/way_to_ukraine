@extends('layouts.default')

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
@endphp

@section('content')
    <article class="container-fluid px-5 second">
        <h2 class="text-center mb-4">@lang('welcome.team')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @foreach ($team as $item)
                    <div class="col-6 col-md-4 my-3">
                        <div class="fund fund-card {{!empty($item['image']) ? 'fund-image': '' }} h-100 text-center"
                            style="background-image: url({{
                                !empty($item['image'])
                                    ? asset($item['image'])
                                    : ''
                                }});">
                            <h3 class="text-center mt-auto">{{ $item['last_name'] }} {{ $item['name'] }}</h3>
                            <i>{{ $item['position'] }}</i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

@endsection


