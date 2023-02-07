<?php

namespace App\Http\Requests\Order;

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
use App\Enums\TypePlan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'plan_id'               => ['integer'],
            'client_id'             => ['integer', 'in:' . listUserPerRoles(["Cliente"], true)],
            'items'                 => ['array', 'in:' . AllowedEnum::values(true)],
            'items.*.chips'         => ['array', Rule::exists("chips", "id")],
            'items.*.antenas'       => ['array', Rule::exists("antenas", "id")],
            'items.*.rastreadores'  => ['array', Rule::exists("rastreadores", "id")],
            'items.*.veiculos'      => ['array', Rule::exists("veiculos", "id")],
        ];
    }

    public function messages()
    {
        return [
            "client_id.in" => "O id que você está tentando passar não é de um cliente!",
            "items.in"     => "Os itens permitidos: " . AllowedEnum::values(true),
        ];
    }
}
