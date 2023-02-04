<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "file_link" => ["file"]
        ];
    }
}
