<?php

namespace App\Http\Requests;

use App\Models\VaccineTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVaccineTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vaccine_tag_edit');
    }

    public function rules()
    {
        return [
            'vaccine_status' => [
                'required',
            ],
        ];
    }
}
