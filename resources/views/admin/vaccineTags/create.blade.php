@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vaccineTag.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vaccine-tags.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.vaccineTag.fields.vaccine_status') }}</label>
                <select class="form-control {{ $errors->has('vaccine_status') ? 'is-invalid' : '' }}" name="vaccine_status" id="vaccine_status" required>
                    <option value disabled {{ old('vaccine_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\VaccineTag::VACCINE_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('vaccine_status', 'Not Yet Implanted') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('vaccine_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vaccine_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaccineTag.fields.vaccine_status_helper') }}</span>
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