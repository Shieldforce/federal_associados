<?php

namespace App\Http\Requests\Plan;

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
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
            'name'                => ['string'],
            'description'         => ['string'],
            'percentage'          => ['integer'],
            'operator'            => ['string', 'in:' . OperatorEnum::values(true)],
            'alloweds'            => ['array'],
            'alloweds.*.type'     => ['required', 'string', 'in:' . AllowedEnum::values(true)],
            'alloweds.*.value'    => ['required', 'string'],
            'alloweds.*.rule'     => ['required', 'boolean'], // Default || Dinamic
        ];
    }

    public function messages()
    {
        return [
            "allowed.in"    => "Permitidos:" . AllowedEnum::values(true),
            "operator.in"   => "Operadoras permitidas:" . OperatorEnum::values(true),
        ];
    }
}
