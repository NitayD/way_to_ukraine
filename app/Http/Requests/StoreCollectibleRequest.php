<?php

namespace App\Http\Requests;

use App\Models\Collectible;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCollectibleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('collectible_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description_short' => [
                'string',
                'nullable',
            ],
            'photo' => [
                'array',
            ],
            'file' => [
                'array',
            ],
        ];
    }
}
