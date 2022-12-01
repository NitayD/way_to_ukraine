@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.collectible.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.collectibles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.collectible.fields.id') }}
                        </th>
                        <td>
                            {{ $collectible->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.collectible.fields.name') }}
                        </th>
                        <td>
                            {{ $collectible->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.collectible.fields.description_short') }}
                        </th>
                        <td>
                            {{ $collectible->description_short }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.collectible.fields.description') }}
                        </th>
                        <td>
                            {!! $collectible->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.collectible.fields.photo') }}
                        </th>
                        <td>
                            @foreach($collectible->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.collectible.fields.file') }}
                        </th>
                        <td>
                            @foreach($collectible->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.collectibles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#item_purchasing_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.purchasingList.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="item_purchasing_lists">
            @includeIf('admin.collectibles.relationships.itemPurchasingLists', ['purchasingLists' => $collectible->itemPurchasingLists])
        </div>
    </div>
</div>

@endsection