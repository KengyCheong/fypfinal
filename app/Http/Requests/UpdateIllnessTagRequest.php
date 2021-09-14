<?php

namespace App\Http\Requests;

use App\Models\IllnessTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIllnessTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('illness_tag_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:illness_tags,name,' . request()->route('illness_tag')->id,
            ],
        ];
    }
}
