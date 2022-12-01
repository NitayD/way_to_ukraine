<?php

namespace App\Http\Requests;

use App\Models\Fundraising;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFundraisingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fundraising_create');
    }

    public function rules()
    {
        return [
            'already_collected' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'title' => [
                'string',
                'required',
            ],
            'description_short' => [
                'string',
                'max:500',
                'nullable',
            ],
            'files' => [
                'array',
            ],
            'gallary' => [
                'array',
            ],
            'sort' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
