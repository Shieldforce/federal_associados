<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanListPublicResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'alloweds'     => AllowedResource::collection($this->alloweds),
            'tracking'     => $this->tracking,
            'protect_plan' => $this->protect_plan,
            'file_link'    => $this->file_link,
            'planDefaultPrice' => $this->defaultPrice(),
        ];
    }

    private function defaultPrice() {
        $value = $this->alloweds()->where('rule', 0)->where('required', true)->pluck('value')->toArray();
        return array_sum($value);
    }
}
