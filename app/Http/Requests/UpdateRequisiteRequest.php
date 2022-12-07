<?php

namespace App\Http\Requests;

use App\Models\Requisite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRequisiteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('requisite_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'label' => [
                'string',
                'required',
            ],
            'value' => [
                'string',
                'required',
            ],
            'priority' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
