<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanListResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'type'         => $this->type,
            'name'         => $this->name,
            'description'  => $this->description,
            'percentage'   => $this->percentage,
            'value'        => $this->value,
            'allowed'      => $this->allowed,
            'operator'     => $this->operator,
            'file_link'    => $this->file_link,
        ];
    }
}
