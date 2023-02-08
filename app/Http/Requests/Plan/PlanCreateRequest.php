<?php

namespace App\Http\Requests\Plan;

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
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
            'name'                => ['required', 'string'],
            'description'         => ['required', 'string'],
            'percentage'          => ['required', 'integer'],
            'operator'            => ['required', 'string', 'in:' . OperatorEnum::values(true)],
            'alloweds'            => ['required', 'array'],
            'alloweds.*.type'     => ['required', 'string', 'in:' . AllowedEnum::names(true)],
            'alloweds.*.value'    => ['required', 'string'],
            'alloweds.*.rule'     => ['required', 'boolean'], // Default || Dinamic
        ];
    }

    public function messages()
    {
        return [
            "alloweds.*.type.in"  => "Permitidos:" . AllowedEnum::names(true),
            "operator.in"         => "Operadoras permitidas:" . OperatorEnum::values(true),
        ];
    }
}
