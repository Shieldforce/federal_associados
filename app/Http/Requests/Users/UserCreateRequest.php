<?php

namespace App\Http\Requests\Users;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{

  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    if (Auth::user()->hasRoles('SA')) {
      return [
        'name' => ['required', 'string', 'min:3'],
        'email' => ['required', 'email', 'min:7', 'unique:users'],
        'password' => ['required', 'min:4', 'confirmed'],
        'password_confirmation' => ['required', 'min:4'],
        'roles' => ["nullable", 'array', "in:" . implode(",", array_values(Role::pluck("name")->toArray()))],
      ];
    } else {
      return [
        'name' => ['required', 'string', 'min:3'],
        'email' => ['required', 'email', 'min:7', 'unique:users'],
        'password' => ['required', 'min:4', 'confirmed'],
        'password_confirmation' => ['required', 'min:4'],
      ];
    }
  }

  public function messages()
  {
    return [
      "roles.in" => "Roles permitidas: " . implode(",", array_values(Role::pluck("name")->toArray()))
    ];
  }
}