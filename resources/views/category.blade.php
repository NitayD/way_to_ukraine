@extends('layouts.default')

@section('content')
    @foreach ($category->pages as $item)
        <div class="row p-3">
            <div class="col">
                <a href="{{ route('page', [
                    'category' => $category->slug ?? $category->id,
                    'page' => $item->id
                ]) }}"><h5>{{$item->title}}</h5></a>
                <small>
                    <i>{{ $item->created_at }}</i>
                </small>
            </div>
            <div class="col-auto">
                <div class="img-fluid">
                </div>
            </div>
        </div>
    @endforeach
@endsection
