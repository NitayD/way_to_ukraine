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
                    <a href="{{ route('fundraisers') }}" class="first--bttn bttn bttn-main bttn-big mt-3">
                        <span>Задонатить</span>
                    </a>
                </div>
            </div>
        </div>
    </article>

    <article class="container-fluid">
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

@push('scripts')
    <script src="{{ asset('/js/probar.js') }}"></script>
    <script>
    </script>
@endpush

