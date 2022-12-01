<?php

namespace App\Http\Requests;

use App\Models\PurchasingList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePurchasingListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('purchasing_list_create');
    }

    public function rules()
    {
        return [
            'funraising_id' => [
                'required',
                'integer',
            ],
            'item_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_sum' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
