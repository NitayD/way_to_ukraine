<div class="list-item">
    <div class="row">
        @if ($item->getMedia('gallary')->count() > 0)
            <div class="col-auto">
                <div class="list-item__preview">
                    <img src="{{ $item->gallary[0]->preview }}" alt="">
                </div>
                <div class="d-flex flex-column">
                </div>
            </div>
        @endif
        <div class="col">
            <div class="d-flex justify-content-between mb-3">
                <div class="list-item__title">
                    {{ $item->title }}
                </div>
                <div class="list-item__date">
                    {{ $item->created_at->format('d.m.Y') }}
                </div>
            </div>
            <div class="list-item__description">
                {{ $item->description_short }}
            </div>
            <a href="{{ route('fundraising', [
                'fundraising' => $item->id
            ]) }}" class="list-item__link">Подробнее</a>
        </div>
    </div>
    @if (!empty($item->funraising_purchasing_lists_sum_total_sum))
        <div class="list-item__progress mt-4">
            <div style="width: {{$item->progress}}%;">{{$item->progress}}%</div>
        </div>
    @endif
</div>
