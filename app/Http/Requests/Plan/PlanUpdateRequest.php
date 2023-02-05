<?php

namespace App\Http\Requests\Plan;

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
use App\Enums\TypePlan;
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
            'type'         => ['string', 'in:' . TypePlan::values(true)],
            'name'         => ['string'],
            'description'  => ['string'],
            'percentage'   => ['integer'],
            'value'        => ['string'],
            'allowed'      => ['array', 'in:' . AllowedEnum::values(true)],
            'operator'     => ['string', 'in:' . OperatorEnum::values(true)],
        ];
    }

    public function messages()
    {
        return [
            "type.in"       => "Tipos permitidos:" . TypePlan::values(true),
            "allowed.in"    => "Permitidos:" . AllowedEnum::values(true),
            "operator.in"   => "Operadoras permitidas:" . OperatorEnum::values(true),
        ];
    }
}
