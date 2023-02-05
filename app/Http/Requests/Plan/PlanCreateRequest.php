<?php

namespace App\Http\Requests\Plan;

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
use App\Enums\TypePlan;
use Illuminate\Foundation\Http\FormRequest;

class PlanCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type'         => ['required', 'string', 'in:' . TypePlan::values(true)],
            'name'         => ['required', 'string'],
            'description'  => ['required', 'string'],
            'percentage'   => ['required', 'integer'],
            'value'        => ['required', 'string'],
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
