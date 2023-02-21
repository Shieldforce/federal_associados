<?php

namespace App\Http\Requests\Plan;

use App\Enums\AllowedEnum;
use Illuminate\Foundation\Http\FormRequest;

class PlanUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                    => ['string'],
            'description'             => ['string'],
            'protect_plan'            => ['boolean'],
            'tracking'                => ['boolean'],
            'alloweds'                => ['array'],
            'alloweds.*.type'         => ['required', 'string', 'in:' . AllowedEnum::names(true)],
            'alloweds.*.value'        => ['string'],
            'alloweds.*.rule'         => ['required', 'boolean'], // Default || Dinamic
            'alloweds.*.required'     => ['boolean'],
        ];
    }

    public function messages()
    {
        return [
            "allowed.in"    => "Permitidos:" . AllowedEnum::names(true),
        ];
    }
}
