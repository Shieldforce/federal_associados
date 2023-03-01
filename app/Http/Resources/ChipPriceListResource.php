<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChipPriceListResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id'             => $this->id,
            'name'           => $this->name,
            "GB"             => $this->GB,
            "allow_voice"    => $this->allow_voice,
            "allow_antenna"  => $this->allow_antenna,
            "price"          => $this->price,
            "operator_id"    => $this->operator_id,
            "operator"       => new OperatorListResource($this->operator),
        ];
    }
}
