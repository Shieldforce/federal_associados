<?php

namespace App\Services\Order;

use App\Enums\AllowedEnum;
use App\Models\Plan;

class CalcPriceFixedService
{
    public static function run(array $data)
    {
        $allowedsRequired = Plan::find($data['plan_id'])
            ->alloweds()
            ?->where('rule', 0)
            ?->where("required", true)
            ->sum("value");

        $totalPrice = $allowedsRequired;

        $alloweds = Plan::find($data['plan_id'])
            ->alloweds()
            ?->where('rule', 0)
            ?->where("required", false)
            ->get();

        foreach ($alloweds as $allowed) {
            $totalPrice += self::calculateMyType($allowed, $data);
        }
        return $totalPrice;
    }

    protected static function calculateMyType($allowed, $data)
    {
        if ($allowed->type == AllowedEnum::ANTENA->name && isset($data['fixed_antenna_id'])) {
            return $allowed->value;
        }

        if ($allowed->type == AllowedEnum::RASTREADOR->name && isset($data["fixed_tracker_id"])) {
            return $allowed->value;
        }

        return 0;
    }
}
