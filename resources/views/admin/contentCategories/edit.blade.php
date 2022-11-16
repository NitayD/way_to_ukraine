@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contentCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-categories.update", [$contentCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_main_page') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_main_page" value="0">
                    <input class="form-check-input" type="checkbox" name="show_main_page" id="show_main_page" value="1" {{ $contentCategory->show_main_page || old('visible', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_main_page">{{ trans('cruds.contentCategory.fields.show_main') }}</label>
                </div>
                @if($errors->has('show_main_page'))
                    <div class="invalid-feedback">
                        {{ $errors->first('show_main_page') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.show_main_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sort">{{ trans('cruds.contentCategory.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="number" name="sort" id="sort" value="{{ old('sort', $contentCategory->sort) }}" step="1" required>
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.sort_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.contentCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $contentCategory->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slug">{{ trans('cruds.contentCategory.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $contentCategory->slug) }}">
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.slug_helper') }}</span>
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
