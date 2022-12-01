<?php

namespace App\Http\Requests;

use App\Models\Fundraising;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFundraisingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fundraising_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fundraisings,id',
        ];
    }
}
