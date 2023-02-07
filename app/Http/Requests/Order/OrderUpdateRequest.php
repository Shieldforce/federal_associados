<?php

namespace App\Http\Requests\Order;

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
use App\Enums\TypePlan;
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
            'plan_id'   => ['integer'],
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
