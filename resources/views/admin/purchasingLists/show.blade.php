@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.purchasingList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.purchasing-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.purchasingList.fields.id') }}
                        </th>
                        <td>
                            {{ $purchasingList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.purchasingList.fields.funraising') }}
                        </th>
                        <td>
                            {{ $purchasingList->funraising->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.purchasingList.fields.item') }}
                        </th>
                        <td>
                            {{ $purchasingList->item->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.purchasingList.fields.amount') }}
                        </th>
                        <td>
                            {{ $purchasingList->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.purchasingList.fields.total_sum') }}
                        </th>
                        <td>
                            {{ $purchasingList->total_sum }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.purchasingList.fields.sort') }}
                        </th>
                        <td>
                            {{ $purchasingList->sort }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.purchasing-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection