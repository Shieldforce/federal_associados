<?php

namespace App\Http\Requests\Order;

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
use App\Enums\TypePlan;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'plan_id'               => ['required', 'integer'],
            'client_id'             => ['required', 'integer', 'in:' . listUserPerRoles(["Cliente"], true)],
            'items'                 => ['required', 'array', 'in:' . AllowedEnum::values(true)],
            'items.*.chips'         => ['required', 'array', Rule::exists("chips", "id")],
            'items.*.antenas'       => ['required', 'array', Rule::exists("antenas", "id")],
            'items.*.rastreadores'  => ['required', 'array', Rule::exists("rastreadores", "id")],
            'items.*.veiculos'      => ['required', 'array', Rule::exists("veiculos", "id")],
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
