@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fundraising.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fundraisings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.id') }}
                        </th>
                        <td>
                            {{ $fundraising->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.finished') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $fundraising->finished ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.already_collected') }}
                        </th>
                        <td>
                            {{ $fundraising->already_collected }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.title') }}
                        </th>
                        <td>
                            {{ $fundraising->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.description_short') }}
                        </th>
                        <td>
                            {{ $fundraising->description_short }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.description') }}
                        </th>
                        <td>
                            {!! $fundraising->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.donation_link') }}
                        </th>
                        <td>
                            {{ $fundraising->donation_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.files') }}
                        </th>
                        <td>
                            @foreach($fundraising->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.gallary') }}
                        </th>
                        <td>
                            @foreach($fundraising->gallary as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fundraising.fields.sort') }}
                        </th>
                        <td>
                            {{ $fundraising->sort }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fundraisings.index') }}">
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
            <a class="nav-link" href="#funraising_purchasing_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.purchasingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#aid_content_pages" role="tab" data-toggle="tab">
                {{ trans('cruds.contentPage.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="funraising_purchasing_lists">
            @includeIf('admin.fundraisings.relationships.funraisingPurchasingLists', ['purchasingLists' => $fundraising->funraisingPurchasingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="aid_content_pages">
            @includeIf('admin.fundraisings.relationships.aidContentPages', ['contentPages' => $fundraising->aidContentPages])
        </div>
    </div>
</div>

@endsection