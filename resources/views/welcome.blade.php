@extends('layouts.default')

@section('content')
    @include('partials.first')

    <article class="container-fluid article-card text-center">
        <div class="container-xxl">
            <h2>@lang('welcome.stat')</h2>
            <div class="row justify-content-center">
                <div class="col-12 col-md-4">
                    <div class="block-stat">
                        ₴ @convert(intval(\App\Models\Fundraising::sum('already_collected')) + 2085000)
                    </div>
                    <h3>
                        @lang('welcome.stats.col1')
                    </h3>
                </div>
                <div class="col-12 col-md-4">
                    <div class="block-stat">
                        12
                    </div>
                    <h3>
                        @lang('welcome.stats.col2')
                    </h3>
                </div>
                <div class="col-12 col-md-4">
                    <div class="block-stat">
                        6
                    </div>
                    <h3>
                        @lang('welcome.stats.col3')
                    </h3>
                </div>
            </div>
        </div>
    </article>

    @include('partials.how_we_work')

    <article class="container-fluid p-5 second">
        <h2 class="text-center mb-4">@lang('welcome.donation.title')</h2>
        <div class="container-xxl">
            <div class="row justify-content-center">
                @empty($funds->count())
                    <div class="col-6 text-center">
                        @lang('welcome.donation.emptyList')
                    </div>
                @endempty
                @foreach ($funds as $item)
                    <div class="col-12 col-md-4 my-3">
                        <div class="block block-secondary">
                            @if ($item->getMedia('gallary')->count() > 0)
                                <figure>
                                    <img src="{{ $item->gallary[0]->preview }}" alt="">
                                </figure>
                            @endif
                            <h3>{{$item->title}}</h3>
                            <div>
                                {{$item->description_short}}
                            </div>
                            @if (!empty($item->funraising_purchasing_lists_sum_total_sum))
                                <div class="fund--progress_ints">
                                    <span>₴ @convert($item->already_collected)</span>
                                    <span>/</span>
                                    <span>₴ @convert($item->funraising_purchasing_lists_sum_total_sum)</span>
                                </div>
                            @else
                                <div class="fund--progress_ints">
                                    @lang('welcome.donate.collected'): <span>₴ @convert($item->already_collected)</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between mt-3">
                                <div class="me-2">
                                    <a href="{{ $item->donation_link }}" class="bttn bttn-white" target="_blank">
                                        @lang('welcome.donate.link')
                                    </a>
                                </div>
                                <div class="ms-2">
                                    <a href="{{ route('fundraising', [
                                        'fundraising' => $item->id
                                    ]) }}" class="bttn">
                                        @lang('welcome.detail')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('fundraisers') }}" class="bttn bttn-big mt-5 more bttn-secondary">@lang('welcome.more')</a>
        </div>
    </article>

    @foreach ($blocks as $item)
        <article class="container-fluid px-5">
            <h2 class="text-center mb-4">
                {{$item->name}}
            </h2>
            <div class="container-xxl">
                <div class="row justify-content-center">
                    @foreach ($item->pages()->orderby('created_at', 'desc')->visible()->limit(3)->get() as $page)
                        <div class="col-12 col-md-4 my-3">
                            <div class="block block-secondary h-100">
                                <figure>
                                    <img src="{{!empty($page->featured_image) ? asset($page->featured_image->getUrl('preview')): ''}}" alt="">
                                </figure>
                                <h3 class="w-100">
                                    {{$page->title}}
                                </h3>
                                <div>
                                    {{$page->excerpt}}
                                </div>
                                <div class="d-flex justify-content-end mt-auto pt-3 w-100">
                                    <a href="{{ route('page', [
                                        'page' => $page->id
                                    ]) }}" class="bttn">
                                        @lang('welcome.detail')
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('category', [
                    'category' => $item->id
                ]) }}" class="bttn bttn-big mt-5 more bttn-secondary">@lang('welcome.more')</a>
            </div>
        </article>
    @endforeach




    @include('partials.requisites', [
        'reqs' => $reqs,
        'nogroup' => $nogroup
    ])
    <div class="d-flex justify-content-center">
        <a href="{{ route('requisites') }}" class="bttn bttn-secondary bttn-big mt-5 more">@lang('welcome.more')</a>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('/js/probar.js') }}"></script>
    <script>
        $(function () {
            let barCouner = 0;
            $('.fund--progress [data-progress]').each(function (ind) {
                let bar = new ProBar({
                    color: "#004491",
                    bgColor: "#FFF3B3",
                    speed: 0.6,
                    wrapper: this,
                    wrapperId: 'bar' + ind,
                    height: 40,
                    finishAnimation: true,
                    rounded: {
                        topLeft: 10,
                        topRight: 10,
                        bottomLeft: 10,
                        bottomRight: 10,
                    }
                });
                bar.goto($(this).data('progress'))
            })
        })
    </script>
@endpush
