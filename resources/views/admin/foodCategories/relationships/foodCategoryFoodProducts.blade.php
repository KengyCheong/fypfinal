@can('food_product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.food-products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.foodProduct.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.foodProduct.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-foodCategoryFoodProducts">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.food_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.food_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.food_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.food_img') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.food_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.food_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodProduct.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foodProducts as $key => $foodProduct)
                        <tr data-entry-id="{{ $foodProduct->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $foodProduct->id ?? '' }}
                            </td>
                            <td>
                                {{ $foodProduct->food_code ?? '' }}
                            </td>
                            <td>
                                {{ $foodProduct->food_category->food_category_name ?? '' }}
                            </td>
                            <td>
                                {{ $foodProduct->food_name ?? '' }}
                            </td>
                            <td>
                                @if($foodProduct->food_img)
                                    <a href="{{ $foodProduct->food_img->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $foodProduct->food_img->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $foodProduct->food_description ?? '' }}
                            </td>
                            <td>
                                {{ $foodProduct->food_price ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FoodProduct::STATUS_SELECT[$foodProduct->status] ?? '' }}
                            </td>
                            <td>
                                @can('food_product_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.food-products.show', $foodProduct->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('food_product_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.food-products.edit', $foodProduct->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('food_product_delete')
                                    <form action="{{ route('admin.food-products.destroy', $foodProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('food_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.food-products.massDestroy') }}",
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
  let table = $('.datatable-foodCategoryFoodProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection