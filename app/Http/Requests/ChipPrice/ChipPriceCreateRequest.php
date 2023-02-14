<?php

namespace App\Http\Requests\ChipPrice;

use Illuminate\Foundation\Http\FormRequest;

class ChipPriceCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => ['required', 'string'],"name",
            "GB"                    => ['required', 'string'],"name",
            "allow_voice"           => ['nullable', 'boolean'],"name",
            "price"                 => ['required', 'string'],"name",
            "operator_id"           => ['required', 'integer'],"name",
        ];
    }

    public function messages()
    {
        return [];
    }
}
