<?php

namespace App\Http\Requests;

use App\Models\UsersInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUsersInfoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('users_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:users_infos,id',
        ];
    }
}
