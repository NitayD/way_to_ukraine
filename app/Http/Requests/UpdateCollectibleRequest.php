<?php

namespace App\Http\Requests;

use App\Models\Collectible;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCollectibleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('collectible_edit');
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
