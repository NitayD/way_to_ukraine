@extends('layouts.admin')
@section('content')
@can('requisite_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.requisites.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.requisite.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.requisite.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Requisite">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.requisite.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisite.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisite.fields.label') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisite.fields.value') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisite.fields.is_link') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisite.fields.priority') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisite.fields.group') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requisites as $key => $requisite)
                        <tr data-entry-id="{{ $requisite->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $requisite->id ?? '' }}
                            </td>
                            <td>
                                {{ $requisite->title ?? '' }}
                            </td>
                            <td>
                                {{ $requisite->label ?? '' }}
                            </td>
                            <td>
                                {{ $requisite->value ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $requisite->is_link ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $requisite->is_link ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $requisite->priority ?? '' }}
                            </td>
                            <td>
                                {{ $requisite->group->name ?? '' }}
                            </td>
                            <td>
                                @can('requisite_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.requisites.show', $requisite->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('requisite_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.requisites.edit', $requisite->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('requisite_delete')
                                    <form action="{{ route('admin.requisites.destroy', $requisite->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('requisite_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.requisites.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Requisite:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection