<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_create');
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
                'string',
               
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
