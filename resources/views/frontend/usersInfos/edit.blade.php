@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.usersInfo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.users-infos.update", [$usersInfo->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.usersInfo.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $usersInfo->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.usersInfo.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nric_no">{{ trans('cruds.usersInfo.fields.nric_no') }}</label>
                            <input class="form-control" type="number" name="nric_no" id="nric_no" value="{{ old('nric_no', $usersInfo->nric_no) }}" step="1" required>
                            @if($errors->has('nric_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nric_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.usersInfo.fields.nric_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="birth_date">{{ trans('cruds.usersInfo.fields.birth_date') }}</label>
                            <input class="form-control date" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date', $usersInfo->birth_date) }}" required>
                            @if($errors->has('birth_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('birth_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.usersInfo.fields.birth_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="phone_no">{{ trans('cruds.usersInfo.fields.phone_no') }}</label>
                            <input class="form-control" type="number" name="phone_no" id="phone_no" value="{{ old('phone_no', $usersInfo->phone_no) }}" step="1" required>
                            @if($errors->has('phone_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.usersInfo.fields.phone_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="illness_history_id">{{ trans('cruds.usersInfo.fields.illness_history') }}</label>
                            <select class="form-control select2" name="illness_history_id" id="illness_history_id" required>
                                @foreach($illness_histories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('illness_history_id') ? old('illness_history_id') : $usersInfo->illness_history->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <textarea class="form-control" name="address" id="address" required>{{ old('address', $usersInfo->address) }}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.usersInfo.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.usersInfo.fields.nationality') }}</label>
                            <select class="form-control" name="nationality" id="nationality" required>
                                <option value disabled {{ old('nationality', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\UsersInfo::NATIONALITY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('nationality', $usersInfo->nationality) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                            <select class="form-control select2" name="vaccine_status_id" id="vaccine_status_id" required>
                                @foreach($vaccine_statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('vaccine_status_id') ? old('vaccine_status_id') : $usersInfo->vaccine_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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

        </div>
    </div>
</div>
@endsection