<?php

namespace App\Http\Requests;

use App\Models\IllnessTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIllnessTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('illness_tag_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:illness_tags',
            ],
        ];
    }
}
