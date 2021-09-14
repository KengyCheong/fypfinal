@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.usersInfo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users-infos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.id') }}
                        </th>
                        <td>
                            {{ $usersInfo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.name') }}
                        </th>
                        <td>
                            {{ $usersInfo->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.nric_no') }}
                        </th>
                        <td>
                            {{ $usersInfo->nric_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.birth_date') }}
                        </th>
                        <td>
                            {{ $usersInfo->birth_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $usersInfo->phone_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.illness_history') }}
                        </th>
                        <td>
                            {{ $usersInfo->illness_history->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.address') }}
                        </th>
                        <td>
                            {{ $usersInfo->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.nationality') }}
                        </th>
                        <td>
                            {{ App\Models\UsersInfo::NATIONALITY_SELECT[$usersInfo->nationality] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usersInfo.fields.vaccine_status') }}
                        </th>
                        <td>
                            {{ $usersInfo->vaccine_status->vaccine_status ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users-infos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection