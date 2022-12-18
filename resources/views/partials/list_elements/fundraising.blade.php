<div class="block block-secondary">
    @if ($item->getMedia('gallary')->count() > 0)
        <figure>
            <img src="{{ $item->gallary[0]->preview }}" alt="">
        </figure>
    @endif
    <h3 class="list-item__title">
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
    <div class="row justify-content-center">
        <div class="col d-flex flex-column @if ($item->itemsSum == 0) text-center @endif">
            <span>Собрано</span>
            ₴ @convert($item->already_collected)
        </div>
        @if ($item->itemsSum > 0 && ($item->itemsSum - $item->already_collected) > 0)
            <div class="col text-end d-flex flex-column">
                <span>Осталось собрать</span>
                <b>₴ @convert($item->itemsSum - $item->already_collected)</b>
            </div>
        @endif
    </div>
    <div class="d-flex mt-3 justify-content-between">
        <a href="{{ $item->donation_link }}" class="bttn bttn-primary">Ссылка на банк</a>
        <a href="{{ route('fundraising', [
            'fundraising' => $item->id
        ]) }}" class="bttn bttn-primary">@lang('welcome.detail')</a>
    </div>
</div>
