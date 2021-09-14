<?php

namespace App\Http\Requests;

use App\Models\UsersInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUsersInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('users_info_edit');
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
                'unique:users_infos,nric_no,' . request()->route('users_info')->id,
            ],
            'birth_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'phone_no' => [
                'required',
                'string',
                'unique:users_infos,phone_no,' . request()->route('users_info')->id,
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
