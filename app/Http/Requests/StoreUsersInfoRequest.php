<?php

namespace App\Http\Requests;

use App\Models\UsersInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUsersInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('users_info_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'nric_no' => [
                'required',
                'string',
                'unique:users_infos,nric_no',
            ],
            'birth_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'phone_no' => [
                'required',
                'string',
                'unique:users_infos,phone_no',
            ],
            'illness_history_id' => [
                'required',
                'integer',
            ],
            'address' => [
                'required',
            ],
            'nationality' => [
                'required',
            ],
            'vaccine_status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
