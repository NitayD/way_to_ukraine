<div class="block block-secondary">
    @if (!empty($item->featuredImage))
        <figure>
            <img src="{{ $item->featuredImage->getUrl('preview') }}" alt="">
        </figure>
    @endif
    <h3 class="list-item__title">
        {{ $item->title }}
    </h3>
    <i class="list-item__date mb-3 mx-0 d-block w-100">{{ $item->created_at->format('d.m.Y') }}</i>
    <div class="list-item__description">
        {{ $item->excerpt }}
    </div>
    <div class="d-flex mt-3 justify-content-end">
        <a href="{{ route('page', [
            'page' => $item->id
        ]) }}" class="bttn bttn-primary">@lang('welcome.detail')</a>
    </div>
</div>
