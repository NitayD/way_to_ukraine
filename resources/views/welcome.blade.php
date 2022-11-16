@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">

        </div>
        <div class="col-12 col-md-6">
            @foreach ($content as $item)
                <div class="text-center mb-3">
                    <h3>{{$item->name}}</h3>
                </div>
                <div class="row mb-4 justify-content-center align-items-center">
                    @foreach ($item->pages()->visible()->take(6)->get() as $subitem)
                        <div class="col-12 col-md-4">
                            <a href="{{ route('page', [
                                'category' => $item->url,
                                'page' => $subitem->id
                            ]) }}" class="main_card">
                                <img src="{{$subitem->featured_image->getUrl('preview')}}" alt="{{$subitem->title}}">
                                <div class="main_card__title">
                                    {{$subitem->title}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
