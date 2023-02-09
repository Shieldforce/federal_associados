<?php

namespace App\Http\Requests\Order;

use App\Enums\AllowedEnum;
use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'items'                        => ['required', 'array'],
            //----------------------------------------------------------------------------------------------------------
            'items.*.id'                   => ['integer'],
            'items.*.type'                 => ['required', 'string', 'in:' . AllowedEnum::names(true)],
            'items.*.cancel_date'          => ['date'],
            'items.*.status'               => ['string'],
            'items.*.number_registration'  => ['string'],
        ];
    }

    public function messages()
    {
        return [
            "items.*.type"  => "Os itens permitidos: " . AllowedEnum::names(true),
        ];
    }
}
