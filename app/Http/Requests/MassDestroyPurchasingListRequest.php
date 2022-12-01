<?php

namespace App\Http\Requests;

use App\Models\PurchasingList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPurchasingListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('purchasing_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:purchasing_lists,id',
        ];
    }
}
