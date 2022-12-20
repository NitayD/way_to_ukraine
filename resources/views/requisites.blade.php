@extends('layouts.default')

@section('content')
    @include('partials.requisites', [
        'reqs' => $reqs,
        'founders' => $founders,
        'nogroup' => $nogroup
    ])
@endsection


