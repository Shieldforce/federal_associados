<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (env("APP_ENV") == "local") {
            User::where("email", "shieldforce2@gmail.com")->delete();
        }

        return [
            "name"                  => ["required", "string", "min:5"],
            "email"                 => ["required", "email", "unique:users"],
            "cpf"                   => ["required", "string", "unique:users"],
            "phone"                 => ["required", "string"],
            "phone2"                => ["required", "string"],
            "password"              => ["required", "confirmed"],
            "password_confirmation" => ["required"],
            "father_uuid"           => ["nullable", Rule::exists('users', 'uuid')],
            'address'               => ['array'],
            "address.cep"           => ["required", "string"],
            "address.address"       => ['required', "string"],
            "address.number"        => ['required', "string"],
            "address.district"      => ['required', "string"],
            "address.city"          => ['required', "string"],
            "address.state"         => ['required', "string"],
            "address.complement"    => ['nullable', "string"],
            "address.refer_point"   => ['required', "string"],
            "plan_id"               => ["required", Rule::exists('plans', 'id')],
            "refer_chip_id"         => ["integer"],
            "refer_antenna_id"      => ["integer"],
            "refer_vehicle_id"      => ["integer"],
            "adhesion_percentage"   => [
                Rule::requiredIf($this["refer_vehicle_id"] && $this["father_uuid"]),
                "numeric",
                "between:0.00,2.00",
            ],
        ];
    }
}
