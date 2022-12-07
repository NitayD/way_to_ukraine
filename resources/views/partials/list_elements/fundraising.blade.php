<div class="list-item">
    @if (!empty($item->funraising_purchasing_lists_sum_total_sum))
        <div class="list-item__progress">
            <div style="width: {{$item->progress}}%;"></div>
        </div>
    @else
        @if ($item->getMedia('gallary')->count() == 0)
            Собрано: <span>€ @convert($item->already_collected)</span>
        @endif
    @endif
    <div class="row">
        @if ($item->getMedia('gallary')->count() > 0)
            <div class="col-auto">
                <div class="list-item__preview">
                    <img src="{{ $item->gallary[0]->preview }}" alt="">
                </div>
                <div class="d-flex flex-column">
                    @if (!empty($item->funraising_purchasing_lists_sum_total_sum))
                            <span>€ @convert($item->already_collected)</span>
                            <span><b>€ @convert($item->funraising_purchasing_lists_sum_total_sum)</b></span>
                    @else
                        <span>Собрано:</span>
                        <span>€ @convert($item->already_collected)</span>
                    @endif
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
        </div>
    </div>
</div>
