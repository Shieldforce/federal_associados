<?php

namespace App\Http\Requests\Order;

use App\Enums\AllowedEnum;
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
            'items'                 => ['array', 'in:' . AllowedEnum::names(true)],

            // Chips ------------------------------------------------
            'items.*.chip'               => ['array'],
            'items.*.chip.id'            => [
                'array',
                Rule::exists("chips", "id"),
            ],
            'items.*.chip.type'          => ['array'],
            'items.*.chip.cancel_date'   => ['array'],
            'items.*.chip.status'        => ['array'],

            // Antena ------------------------------------------------
            'items.*.antenna'        => ['array'],
            'items.*.antenna.id'            => [
                'array',
                Rule::exists("antennae", "id"),
            ],
            'items.*.antenna.type'          => ['array'],
            'items.*.antenna.cancel_date'   => ['array'],
            'items.*.antenna.status'        => ['array'],

            // Ratreador --------------------------------------------
            'items.*.tracker'    => ['array'],
            'items.*.tracker.id'            => [
                'array',
                Rule::exists("trackers", "id"),
            ],
            'items.*.tracker.type'          => ['array'],
            'items.*.tracker.cancel_date'   => ['array'],
            'items.*.tracker.status'        => ['array'],

            // Veículo ----------------------------------------------
            'items.*.vehicle'       => ['array'],
            'items.*.vehicle.id'            => [
                'array',
                Rule::exists("vehicles", "id"),
            ],
            'items.*.vehicle.type'          => ['array', 'in:rented,own'],
            'items.*.vehicle.cancel_date'   => ['array'],
            'items.*.vehicle.status'        => ['array'],
        ];
    }

    public function messages()
    {
        return [
            "items.in"     => "Os itens permitidos: " . AllowedEnum::names(true),
        ];
    }
}
