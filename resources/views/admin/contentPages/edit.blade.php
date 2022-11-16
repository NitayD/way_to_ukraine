@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contentPage.title_singular') }}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#ua-form">UA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#en-form">EN</a>
            </li>
        </ul>
        <form method="POST" action="{{ route("admin.content-pages.update", [$contentPage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('visible') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="visible" value="0">
                    <input class="form-check-input" type="checkbox" name="visible" id="visible" value="1" {{ $contentPage->visible || old('visible', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="visible">{{ trans('cruds.contentPage.fields.visible') }}</label>
                </div>
                @if($errors->has('visible'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visible') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.visible_helper') }}</span>
            </div>


            <div class="tab-content">
                <div class="tab-pane active" id="ua-form">
                    <div class="form-group">
                        <label class="required" for="ua_title">{{ trans('cruds.contentPage.fields.title') }} (UA)</label>
                        <input class="form-control {{ $errors->has('ua_title') ? 'is-invalid' : '' }}" type="text" name="ua_title" id="ua_title" value="{{ old('title', $contentPage->translate('ua')->title) }}" required>
                        @if($errors->has('ua_title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ua_title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.contentPage.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="ua_excerpt">{{ trans('cruds.contentPage.fields.excerpt') }} (UA)</label>
                        <textarea class="form-control {{ $errors->has('ua_excerpt') ? 'is-invalid' : '' }}" name="ua_excerpt" id="ua_excerpt">{{ old('ua_excerpt', $contentPage->translate('ua')->excerpt) }}</textarea>
                        @if($errors->has('ua_excerpt'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ua_excerpt') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.contentPage.fields.excerpt_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="page_text">{{ trans('cruds.contentPage.fields.page_text') }} (UA)</label>
                        <textarea class="form-control ckeditor {{ $errors->has('ua_page_text') ? 'is-invalid' : '' }}" name="ua_page_text" id="ua_page_text">{!! old('ua_page_text', $contentPage->translate('ua')->page_text) !!}</textarea>
                        @if($errors->has('ua_page_text'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ua_page_text') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.contentPage.fields.page_text_helper') }}</span>
                    </div>
                </div>

                <div class="tab-pane" id="en-form">
                    <div class="form-group">
                        <label class="required" for="en_title">{{ trans('cruds.contentPage.fields.title') }} (EN)</label>
                        <input class="form-control {{ $errors->has('en_title') ? 'is-invalid' : '' }}" type="text" name="en_title" id="en_title" value="{{ old('en_title', $contentPage->translate('en')->title) }}" required>
                        @if($errors->has('en_title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.contentPage.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="en_excerpt">{{ trans('cruds.contentPage.fields.excerpt') }} (EN)</label>
                        <textarea class="form-control {{ $errors->has('en_excerpt') ? 'is-invalid' : '' }}" name="en_excerpt" id="en_excerpt">{{ old('en_excerpt', $contentPage->translate('en')->excerpt) }}</textarea>
                        @if($errors->has('en_excerpt'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_excerpt') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.contentPage.fields.excerpt_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="en_page_text">{{ trans('cruds.contentPage.fields.page_text') }} (EN)</label>
                        <textarea class="form-control ckeditor {{ $errors->has('page_text') ? 'is-invalid' : '' }}" name="en_page_text" id="en_page_text">{!! old('en_page_text', $contentPage->translate('en')->page_text) !!}</textarea>
                        @if($errors->has('en_page_text'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_page_text') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.contentPage.fields.page_text_helper') }}</span>
                    </div>
                </div>

            </div>


            <div class="form-group">
                <label for="categories">{{ trans('cruds.contentPage.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $contentPage->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.contentPage.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $contentPage->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="featured_image">{{ trans('cruds.contentPage.fields.featured_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                </div>
                @if($errors->has('featured_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.featured_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="images">{{ trans('cruds.contentPage.fields.images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('images') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.images_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.content-pages.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $contentPage->id ?? 0 }}');
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
    Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="featured_image"]').remove()
      $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="featured_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($contentPage) && $contentPage->featured_image)
      var file = {!! json_encode($contentPage->featured_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($contentPage) && $contentPage->images)
      var files = {!! json_encode($contentPage->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
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
