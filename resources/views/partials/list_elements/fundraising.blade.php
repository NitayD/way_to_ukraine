<div class="block block-secondary">
    @if ($item->getMedia('gallary')->count() > 0)
        <figure>
            <img src="{{ $item->gallary[0]->preview }}" alt="">
        </figure>
    @endif
    <h3>
        {{ $item->title }}
    </h3>
    <i class="list-item__date mb-3 mx-0 d-block w-100">{{ $item->created_at->format('d.m.Y') }}</i>
    <div class="list-item__description">
        {{ $item->description_short }}
    </div>
    @if ($item->itemsSum > 0)
        <div class="fundlist__progress mb-3 mx-n3">
            <div class="fundlist__progress--bar fundlist__progress--bar--primary"><span style="width: {{$item->progress}}%;"></span></div>
            {{$item->progress}}%
        </div>
    @endif
    <div class="row justify-content-center mt-3">
        <div class="col d-flex flex-column @if ($item->itemsSum == 0) text-center @endif">
            <span>@lang('welcome.donate.collected')</span>
            <b>₴ @convert($item->already_collected)</b>
        </div>
        @if ($item->itemsSum > 0 && ($item->itemsSum - $item->already_collected) > 0)
            <div class="col text-end d-flex flex-column">
                <span>@lang('welcome.donate.left')</span>
                <b>₴ @convert($item->itemsSum - $item->already_collected)</b>
            </div>
        @endif
    </div>
    <div class="d-flex mt-3 justify-content-between">
        <div class="me-2">
            <a href="{{ $item->donation_link }}" class="bttn bttn-primary" target="_blank">@lang('welcome.donate.link')</a>
        </div>
        <div class="ms-2">
            <a href="{{ route('fundraising', [
                'fundraising' => $item->id
            ]) }}" class="bttn bttn-primary">@lang('welcome.detail')</a>
        </div>
    </div>
</div>
