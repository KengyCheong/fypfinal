@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vaccineTag.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vaccine-tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vaccineTag.fields.id') }}
                        </th>
                        <td>
                            {{ $vaccineTag->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vaccineTag.fields.vaccine_status') }}
                        </th>
                        <td>
                            {{ App\Models\VaccineTag::VACCINE_STATUS_SELECT[$vaccineTag->vaccine_status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vaccine-tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#vaccine_status_users_infos" role="tab" data-toggle="tab">
                {{ trans('cruds.usersInfo.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="vaccine_status_users_infos">
            @includeIf('admin.vaccineTags.relationships.vaccineStatusUsersInfos', ['usersInfos' => $vaccineTag->vaccineStatusUsersInfos])
        </div>
    </div>
</div>

@endsection