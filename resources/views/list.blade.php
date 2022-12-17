@extends('layouts.default', [
    'breadcrumbs' => [
        [
            'text' => trans('welcome.main.title'),
            'link' => route('main'),
        ],
        [
            'text' => $title,
        ],
    ]
])

@section('content')
    <article class="container-fluid mt-3">
        <h2 class="mb-4">{{ $title }}</h2>
        <div class="container-xxl">
            <div class="row">
                @foreach ($list as $item)
                    <div class="col-12 col-md-6 my-3">
                        @include('partials.list_elements.'.$itemType, ['item' => $item])
                    </div>
                @endforeach
            </div>
        </div>
    </article>

@endsection

