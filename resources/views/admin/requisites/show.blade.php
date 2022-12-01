@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.requisite.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.requisites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.requisite.fields.id') }}
                        </th>
                        <td>
                            {{ $requisite->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisite.fields.label') }}
                        </th>
                        <td>
                            {{ $requisite->label }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisite.fields.value') }}
                        </th>
                        <td>
                            {{ $requisite->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisite.fields.priority') }}
                        </th>
                        <td>
                            {{ $requisite->priority }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisite.fields.group') }}
                        </th>
                        <td>
                            {{ $requisite->group->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.requisites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection