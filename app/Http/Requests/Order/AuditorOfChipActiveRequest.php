<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AuditorOfChipActiveRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'iccids' => ['required', 'array'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
