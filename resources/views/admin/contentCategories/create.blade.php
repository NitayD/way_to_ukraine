@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contentCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.contentCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slug">{{ trans('cruds.contentCategory.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_short">{{ trans('cruds.contentCategory.fields.description_short') }}</label>
                <input class="form-control {{ $errors->has('description_short') ? 'is-invalid' : '' }}" type="text" name="description_short" id="description_short" value="{{ old('description_short', '') }}">
                @if($errors->has('description_short'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_short') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.description_short_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.contentCategory.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_menu') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_menu" value="0">
                    <input class="form-check-input" type="checkbox" name="show_menu" id="show_menu" value="1" {{ old('show_menu', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_menu">{{ trans('cruds.contentCategory.fields.show_menu') }}</label>
                </div>
                @if($errors->has('show_menu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('show_menu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.show_menu_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_main_page') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_main_page" value="0">
                    <input class="form-check-input" type="checkbox" name="show_main_page" id="show_main_page" value="1" {{ old('show_main_page', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_main_page">{{ trans('cruds.contentCategory.fields.show_main_page') }}</label>
                </div>
                @if($errors->has('show_main_page'))
                    <div class="invalid-feedback">
                        {{ $errors->first('show_main_page') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentCategory.fields.show_main_page_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.content-categories.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $contentCategory->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection