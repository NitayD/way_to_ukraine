@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.fundraising.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fundraisings.update", [$fundraising->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('finished') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="finished" value="0">
                    <input class="form-check-input" type="checkbox" name="finished" id="finished" value="1" {{ $fundraising->finished || old('finished', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="finished">{{ trans('cruds.fundraising.fields.finished') }}</label>
                </div>
                @if($errors->has('finished'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finished') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.finished_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="already_collected">{{ trans('cruds.fundraising.fields.already_collected') }}</label>
                <input class="form-control {{ $errors->has('already_collected') ? 'is-invalid' : '' }}" type="number" name="already_collected" id="already_collected" value="{{ old('already_collected', $fundraising->already_collected) }}" step="1" required>
                @if($errors->has('already_collected'))
                    <div class="invalid-feedback">
                        {{ $errors->first('already_collected') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.already_collected_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.fundraising.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $fundraising->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_short">{{ trans('cruds.fundraising.fields.description_short') }}</label>
                <input class="form-control {{ $errors->has('description_short') ? 'is-invalid' : '' }}" type="text" name="description_short" id="description_short" value="{{ old('description_short', $fundraising->description_short) }}">
                @if($errors->has('description_short'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_short') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.description_short_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.fundraising.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $fundraising->description) !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.fundraising.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gallary">{{ trans('cruds.fundraising.fields.gallary') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gallary') ? 'is-invalid' : '' }}" id="gallary-dropzone">
                </div>
                @if($errors->has('gallary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gallary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.gallary_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sort">{{ trans('cruds.fundraising.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="number" name="sort" id="sort" value="{{ old('sort', $fundraising->sort) }}" step="1">
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fundraising.fields.sort_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.fundraisings.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $fundraising->id ?? 0 }}');
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

<script>
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.fundraisings.storeMedia') }}',
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($fundraising) && $fundraising->files)
          var files =
            {!! json_encode($fundraising->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedGallaryMap = {}
Dropzone.options.gallaryDropzone = {
    url: '{{ route('admin.fundraisings.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 8000,
      height: 8000
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="gallary[]" value="' + response.name + '">')
      uploadedGallaryMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedGallaryMap[file.name]
      }
      $('form').find('input[name="gallary[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($fundraising) && $fundraising->gallary)
      var files = {!! json_encode($fundraising->gallary) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="gallary[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection