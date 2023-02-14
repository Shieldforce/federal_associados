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
            'client'  => $this->client,
            "value"  => $this->value,
            "status"  => $this->status,
            "dueDate"  => $this->dueDate,
            "reference"  => $this->reference,
            "type"  => $this->type,
            "description"  => $this->description,
            "activationDate"  => $this->activationDate,
            "cancellationDate"  => $this->cancellationDate,
        ];
    }
}
