<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllowedResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'type' => $this->type,
            'value' => $this->value,
            'rule' => $this->rule,
            'required' => $this->required,
        ];
    }
}
