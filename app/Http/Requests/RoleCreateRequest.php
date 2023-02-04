<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RoleCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ["required",Rule::unique('roles','name')],
            'description' => ["string"],
            'approver' => ["boolean"],
            "allow_attachment" => ["boolean"],
            "standard_answer" => ["boolean"],
            "permissions_names"  => ["required", "array", "in:".implode(",", Permission::pluck("name")->toArray())]
        ];
    }

    public function messages()
    {
        return [
            "permissions_names.in" => "Permissões aceitas: ".implode(",", Permission::pluck("name")->toArray()),
        ];
    }
}
