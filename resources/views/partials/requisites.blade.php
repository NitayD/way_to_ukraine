<article class="container-fluid second">
    <h2 class="text-center mb-4">@lang('welcome.reqs')</h2>
    @isset($founders)
        <div class="container-xxl d-flex justify-content-center">
            <div class="block block-secondary d-inline-flex my-3 block-table">
                <h4><b>@lang('welcome.donation.title')</b></h4>
                <table class="mx-auto">
                    <tbody>
                        @foreach ($founders as $item)
                            <tr>
                                <th title="{{$item->title}}" class="p-3">{{$item->title}}</th>
                                <td class="px-3">{{ $item->progress }}%</td>
                                <td class="text-end">
                                    <a href="{{$item->donation_link}}" class="bttn bttn-primary">
                                        @lang('welcome.donate.btn')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endisset
    <div class="container-xxl">
        <div class="row justify-content-center">
            @isset($reqs)
                @foreach ($reqs as $item)
                    <div class="col-12 col-md-6">
                        <div class="block block-secondary my-3 block-table">
                            <h4><b>{{ $item->name }}</b></h4>
                            <table>
                                <tbody>
                                    @foreach ($item->groupRequisites as $req)
                                        <tr>
                                            <th title="{{ $req->label }}">{{ $req->label }}</th>
                                            <td class="text-end copy" title="{{ $req->value }}">{{ $req->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endisset
            @isset($nogroup)
                @if ($nogroup->count() > 0)
                    <div class="col-12 col-md-6">
                        <div class="block block-secondary my-3 block-table">
                            <h4><b>@lang('welcome.donate.other')</b></h4>
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
            @endisset
        </div>
    </div>
</article>
