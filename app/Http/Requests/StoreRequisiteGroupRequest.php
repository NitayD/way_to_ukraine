<?php

namespace App\Http\Requests;

use App\Models\RequisiteGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRequisiteGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('requisite_group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
                'unique:requisite_groups',
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
