@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contentCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $contentCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $contentCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.slug') }}
                        </th>
                        <td>
                            {{ $contentCategory->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.description_short') }}
                        </th>
                        <td>
                            {{ $contentCategory->description_short }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.description') }}
                        </th>
                        <td>
                            {!! $contentCategory->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.show_menu') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $contentCategory->show_menu ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.show_main_page') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $contentCategory->show_main_page ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection