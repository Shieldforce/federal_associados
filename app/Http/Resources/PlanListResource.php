<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanListResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'percentage'   => $this->percentage,
            'alloweds'     => $this->alloweds,
            'operator'     => $this->operator,
            'file_link'    => $this->file_link,
        ];
    }
}
