<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderListResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id'      => $this->id,
            'plan'    => $this->plan,
            'client'  => $this->client
        ];
    }
}
