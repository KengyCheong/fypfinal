<?php

namespace App\Http\Requests;

use App\Models\VaccineTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVaccineTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vaccine_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vaccine_tags,id',
        ];
    }
}
