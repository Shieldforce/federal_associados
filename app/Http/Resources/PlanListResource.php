<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanListResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'percentage' => $this->percentage,
            'min_price' => $this->min_price,
            'alloweds' => AllowedResource::collection($this->alloweds),
            'tracking' => $this->tracking,
            'protect_plan' => $this->protect_plan,
            'file_link' => $this->file_link,
        ];
    }
}