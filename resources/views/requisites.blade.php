@extends('layouts.default')

@section('content')
    <article class="container-fluid px-5 second">
        <h2 class="text-center mb-4">@lang('welcome.reqs')</h2>
        <div class="container-xxl">
            <div class="fund fund-white my-3">
                <h4><b>Основные сборы</b></h4>
                <table>
                    <tbody>
                            <tr>
                                <th>фыв</th>
                                <td class="text-end copy">фыв</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                @foreach ($reqs as $item)
                    <div class="col-12 col-md-6">
                        <div class="fund fund-white my-3">
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
                @if (!empty($nogroup))
                    <div class="col-12 col-md-6">
                        <div class="fund fund-white my-3">
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


