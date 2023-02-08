<?php

namespace App\Http\Requests\Order;

use App\Enums\AllowedEnum;
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

            // Chips ------------------------------------------------
            'items.*.chip'               => ['array'],
            'items.*.chip.id'            => [
                'array',
                Rule::exists("chip", "id"),
                Rule::unique("items", "model_id")
                    ->where(fn($query) => $query->where("model_type", "\\App\\Models\\Chip"))
            ],
            'items.*.chip.type'          => ['array'],
            'items.*.chip.cancel_date'   => ['array'],
            'items.*.chip.status'        => ['array'],

            // Antena ------------------------------------------------
            'items.*.antenna'        => ['array'],
            'items.*.antenna.id'            => [
                'array',
                Rule::exists("antennae", "id"),
                Rule::unique("items", "model_id")
                    ->where(fn($query) => $query->where("model_type", "\\App\\Models\\Antenna"))
            ],
            'items.*.antenna.type'          => ['array'],
            'items.*.antenna.cancel_date'   => ['array'],
            'items.*.antenna.status'        => ['array'],

            // Ratreador --------------------------------------------
            'items.*.tracker'    => ['array'],
            'items.*.tracker.id'            => [
                'array',
                Rule::exists("trackers", "id"),
                Rule::unique("items", "model_id")
                    ->where(fn($query) => $query->where("model_type", "\\App\\Models\\Tracker"))
            ],
            'items.*.tracker.type'          => ['array'],
            'items.*.tracker.cancel_date'   => ['array'],
            'items.*.tracker.status'        => ['array'],

            // Veículo ----------------------------------------------
            'items.*.vehicle'       => ['array'],
            'items.*.vehicle.id'            => [
                'array',
                Rule::exists("vehicles", "id"),
                Rule::unique("items", "model_id")
                    ->where(fn($query) => $query->where("model_type", "\\App\\Models\\Vehicle"))
            ],
            'items.*.vehicle.type'          => ['array', 'in:rented,own'],
            'items.*.vehicle.cancel_date'   => ['array'],
            'items.*.vehicle.status'        => ['array'],
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
