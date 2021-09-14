<?php

namespace App\Http\Requests;

use App\Models\ApprovalStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreApprovalStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('approval_status_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
