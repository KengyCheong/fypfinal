@extends('layouts.admin')
@section('content')
@can('vaccine_tag_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vaccine-tags.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vaccineTag.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.vaccineTag.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-VaccineTag">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.vaccineTag.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaccineTag.fields.vaccine_status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vaccineTags as $key => $vaccineTag)
                        <tr data-entry-id="{{ $vaccineTag->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $vaccineTag->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\VaccineTag::VACCINE_STATUS_SELECT[$vaccineTag->vaccine_status] ?? '' }}
                            </td>
                            <td>
                                @can('vaccine_tag_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.vaccine-tags.show', $vaccineTag->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('vaccine_tag_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.vaccine-tags.edit', $vaccineTag->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('vaccine_tag_delete')
                                    <form action="{{ route('admin.vaccine-tags.destroy', $vaccineTag->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vaccine_tag_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vaccine-tags.massDestroy') }}",
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
  let table = $('.datatable-VaccineTag:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection