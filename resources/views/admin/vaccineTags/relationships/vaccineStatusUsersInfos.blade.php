@can('users_info_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users-infos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.usersInfo.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.usersInfo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-vaccineStatusUsersInfos">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.nric_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.birth_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.phone_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.illness_history') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.nationality') }}
                        </th>
                        <th>
                            {{ trans('cruds.usersInfo.fields.vaccine_status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usersInfos as $key => $usersInfo)
                        <tr data-entry-id="{{ $usersInfo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $usersInfo->id ?? '' }}
                            </td>
                            <td>
                                {{ $usersInfo->name ?? '' }}
                            </td>
                            <td>
                                {{ $usersInfo->nric_no ?? '' }}
                            </td>
                            <td>
                                {{ $usersInfo->birth_date ?? '' }}
                            </td>
                            <td>
                                {{ $usersInfo->phone_no ?? '' }}
                            </td>
                            <td>
                                {{ $usersInfo->illness_history->name ?? '' }}
                            </td>
                            <td>
                                {{ $usersInfo->address ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\UsersInfo::NATIONALITY_SELECT[$usersInfo->nationality] ?? '' }}
                            </td>
                            <td>
                                {{ $usersInfo->vaccine_status->vaccine_status ?? '' }}
                            </td>
                            <td>
                                @can('users_info_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.users-infos.show', $usersInfo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('users_info_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users-infos.edit', $usersInfo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('users_info_delete')
                                    <form action="{{ route('admin.users-infos.destroy', $usersInfo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('users_info_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users-infos.massDestroy') }}",
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
  let table = $('.datatable-vaccineStatusUsersInfos:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection