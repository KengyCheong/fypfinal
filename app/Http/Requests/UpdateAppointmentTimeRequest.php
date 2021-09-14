<?php

namespace App\Http\Requests;

use App\Models\AppointmentTime;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentTimeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_time_edit');
    }

    public function rules()
    {
        return [
            'time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
