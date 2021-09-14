@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.usersInfo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users-infos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.usersInfo.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nric_no">{{ trans('cruds.usersInfo.fields.nric_no') }}</label>
                <input class="form-control {{ $errors->has('nric_no') ? 'is-invalid' : '' }}" type="number" name="nric_no" id="nric_no" value="{{ old('nric_no', '') }}" step="1" required>
                @if($errors->has('nric_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nric_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.nric_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="birth_date">{{ trans('cruds.usersInfo.fields.birth_date') }}</label>
                <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
                @if($errors->has('birth_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birth_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.birth_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_no">{{ trans('cruds.usersInfo.fields.phone_no') }}</label>
                <input class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" type="number" name="phone_no" id="phone_no" value="{{ old('phone_no', '') }}" step="1" required>
                @if($errors->has('phone_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.phone_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="illness_history_id">{{ trans('cruds.usersInfo.fields.illness_history') }}</label>
                <select class="form-control select2 {{ $errors->has('illness_history') ? 'is-invalid' : '' }}" name="illness_history_id" id="illness_history_id" required>
                    @foreach($illness_histories as $id => $entry)
                        <option value="{{ $id }}" {{ old('illness_history_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('illness_history'))
                    <div class="invalid-feedback">
                        {{ $errors->first('illness_history') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.illness_history_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.usersInfo.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address') }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.usersInfo.fields.nationality') }}</label>
                <select class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" name="nationality" id="nationality" required>
                    <option value disabled {{ old('nationality', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UsersInfo::NATIONALITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('nationality', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vaccine_status_id">{{ trans('cruds.usersInfo.fields.vaccine_status') }}</label>
                <select class="form-control select2 {{ $errors->has('vaccine_status') ? 'is-invalid' : '' }}" name="vaccine_status_id" id="vaccine_status_id" required>
                    @foreach($vaccine_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('vaccine_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vaccine_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vaccine_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usersInfo.fields.vaccine_status_helper') }}</span>
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