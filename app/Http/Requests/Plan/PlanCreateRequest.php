<?php

namespace App\Http\Requests\Plan;

use App\Enums\AllowedEnum;
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'protect_plan' => ['required', 'boolean'],
            'min_price' => ['required', 'number'],
            'tracking' => ['required', 'boolean'],
            'alloweds' => ['required', 'array'],
            'alloweds.*.type' => ['required', 'string', 'in:' . AllowedEnum::names(true)],
            'alloweds.*.value' => ['string'],
            'alloweds.*.rule' => ['required', 'boolean'],
            // Default || Dinamic
            'alloweds.*.required' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            "alloweds.*.type.in" => "Permitidos:" . AllowedEnum::names(true),
        ];
    }
}