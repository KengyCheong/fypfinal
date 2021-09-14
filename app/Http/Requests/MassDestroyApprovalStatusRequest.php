<?php

namespace App\Http\Requests;

use App\Models\ApprovalStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyApprovalStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('approval_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:approval_statuses,id',
        ];
    }
}
