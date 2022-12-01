<?php

namespace App\Http\Requests;

use App\Models\RequisiteGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequisiteGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('requisite_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:requisite_groups,id',
        ];
    }
}
