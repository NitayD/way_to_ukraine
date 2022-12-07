<div class="list-item">
    <div class="row">
        @if ($item->featuredImage)
            <div class="col-auto">
                <div class="list-item__preview">
                    <img src="{{ $item->featuredImage->preview }}" alt="">
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
                {{ $item->excerpt }}
            </div>
        </div>
    </div>
</div>
