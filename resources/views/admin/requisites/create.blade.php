@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.requisite.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.requisites.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.requisite.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisite.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="label">{{ trans('cruds.requisite.fields.label') }}</label>
                <input class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" type="text" name="label" id="label" value="{{ old('label', '') }}" required>
                @if($errors->has('label'))
                    <div class="invalid-feedback">
                        {{ $errors->first('label') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisite.fields.label_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.requisite.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', '') }}" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisite.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_link') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_link" value="0">
                    <input class="form-check-input" type="checkbox" name="is_link" id="is_link" value="1" {{ old('is_link', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_link">{{ trans('cruds.requisite.fields.is_link') }}</label>
                </div>
                @if($errors->has('is_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisite.fields.is_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="priority">{{ trans('cruds.requisite.fields.priority') }}</label>
                <input class="form-control {{ $errors->has('priority') ? 'is-invalid' : '' }}" type="number" name="priority" id="priority" value="{{ old('priority', '10') }}" step="1" required>
                @if($errors->has('priority'))
                    <div class="invalid-feedback">
                        {{ $errors->first('priority') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisite.fields.priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="group_id">{{ trans('cruds.requisite.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ old('group_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisite.fields.group_helper') }}</span>
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