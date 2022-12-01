<?php

namespace App\Http\Requests;

use App\Models\Requisite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequisiteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('requisite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:requisites,id',
        ];
    }
}
