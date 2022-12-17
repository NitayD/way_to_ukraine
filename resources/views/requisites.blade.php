@extends('layouts.default')

@section('content')
    <article class="container-fluid px-5 second">
        <h2 class="text-center mb-4">@lang('welcome.reqs')</h2>
        <div class="container-xxl d-flex justify-content-center">
            <div class="block block-secondary d-inline-flex my-3">
                <h4><b>Основные сборы</b></h4>
                <table class="mx-auto">
                    <tbody>
                        @foreach ($founders as $item)
                            <tr>
                                <th class="p-3">{{$item->title}}</th>
                                <td class="px-3">{{ $item->progress }}%</td>
                                <td class="text-end">
                                    <a href="{{$item->donation_link}}" class="bttn bttn-primary">
                                        @lang('welcome.donate')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-xxl">
            <div class="row">
                @foreach ($reqs as $item)
                    <div class="col-12 col-md-6">
                        <div class="block block-secondary my-3">
                            <h4><b>{{ $item->name }}</b></h4>
                            <table>
                                <tbody>
                                    @foreach ($item->groupRequisites as $req)
                                        <tr>
                                            <th>{{ $req->label }}</th>
                                            <td class="text-end copy">{{ $req->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
                @if ($nogroup->count() > 0)
                    <div class="col-12 col-md-6">
                        <div class="block block-secondary my-3">
                            <h4><b>-</b></h4>
                            <table>
                                <tbody>
                                    @foreach ($nogroup as $req)
                                        <tr>
                                            <th>{{ $req->label }}</th>
                                            <td class="text-end copy">{{ $req->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </article>

@endsection


