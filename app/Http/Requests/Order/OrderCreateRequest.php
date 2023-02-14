<?php

namespace App\Http\Requests\Order;

use App\Enums\AllowedEnum;
use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'plan_id'                      => ['required', 'integer'],
            'client_id'                    => ['required', 'integer', 'in:' . listUserPerRoles(["Cliente"], true)],
            'shipping_id'                  => ['required', 'integer'],
            'items'                        => ['required', 'array'],
            //----------------------------------------------------------------------------------------------------------
            'items.*.id'                   => ['integer'],
            'items.*.type'                 => ['required', 'string', 'in:' . AllowedEnum::names(true)],
            'items.*.cancel_date'          => ['date'],
            'items.*.status'               => ['string'],
            'items.*.number_registration'  => ['string'],
            'items.*.reference_price_id'   => ['integer'],
        ];
    }

    public function messages()
    {
        return [
            "client_id.in"  => "O id que você está tentando passar não é de um cliente!",
            "items.*.type"  => "Os itens permitidos: " . AllowedEnum::names(true),
        ];
    }
}
