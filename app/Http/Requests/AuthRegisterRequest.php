<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"                        => ["required", "string", "min:5"],
            "email"                       => ["required", "email", "unique:users"],
            "password"                    => ["required", "string"],
            "cpf"                         => ["required", "string", "unique:users"],
            "phone"                       => ["required", "string"],
            "phone2"                      => ["required", "string"],
            "password"                    => ["required", "confirmed"],
            "password_confirmation"       => ["required"],
            "father_uuid"                 => ["nullable", Rule::exists('users','uuid')],
            'address'                     => ['array'],
            "address.cep"                 => ["required", "string"],
            "address.address"             => ['required', "string"],
            "address.number"              => ['required', "string"],
            "address.district"            => ['required', "string"],
            "address.city"                => ['required', "string"],
            "address.state"               => ['required', "string"],
            "address.complement"          => ['nullable', "string"],
            "address.refer_point"         => ['required', "string"],
            "plan_id"                     => ["required", Rule::exists('plans','id')]
        ];
    }
}
