<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'nric' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'appointment_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
