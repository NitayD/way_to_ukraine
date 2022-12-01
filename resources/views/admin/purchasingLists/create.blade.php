@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.purchasingList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.purchasing-lists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="funraising_id">{{ trans('cruds.purchasingList.fields.funraising') }}</label>
                <select class="form-control select2 {{ $errors->has('funraising') ? 'is-invalid' : '' }}" name="funraising_id" id="funraising_id" required>
                    @foreach($funraisings as $id => $entry)
                        <option value="{{ $id }}" {{ old('funraising_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('funraising'))
                    <div class="invalid-feedback">
                        {{ $errors->first('funraising') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchasingList.fields.funraising_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="item_id">{{ trans('cruds.purchasingList.fields.item') }}</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ old('item_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                    <div class="invalid-feedback">
                        {{ $errors->first('item') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchasingList.fields.item_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.purchasingList.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="1" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchasingList.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_sum">{{ trans('cruds.purchasingList.fields.total_sum') }}</label>
                <input class="form-control {{ $errors->has('total_sum') ? 'is-invalid' : '' }}" type="number" name="total_sum" id="total_sum" value="{{ old('total_sum', '') }}" step="1" required>
                @if($errors->has('total_sum'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_sum') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchasingList.fields.total_sum_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sort">{{ trans('cruds.purchasingList.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="number" name="sort" id="sort" value="{{ old('sort', '1000') }}" step="1">
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchasingList.fields.sort_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection