@extends('layouts.admin')
@section('content')
@can('fundraising_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fundraisings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fundraising.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.fundraising.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Fundraising">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.finished') }}
                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.already_collected') }}
                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.description_short') }}
                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.donation_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.files') }}
                    </th>
                    <th>
                        {{ trans('cruds.fundraising.fields.sort') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fundraising_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fundraisings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.fundraisings.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'finished', name: 'finished' },
{ data: 'already_collected', name: 'already_collected' },
{ data: 'title', name: 'title' },
{ data: 'description_short', name: 'description_short' },
{ data: 'donation_link', name: 'donation_link' },
{ data: 'files', name: 'files', sortable: false, searchable: false },
{ data: 'sort', name: 'sort' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Fundraising').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection