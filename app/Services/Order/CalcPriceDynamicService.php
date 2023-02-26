<?php

namespace App\Services\Order;

use App\Enums\AllowedEnum;
use App\Models\ChipPrice;
use App\Models\Fipe\FipeVehicle;
use App\Models\Plan;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalcPriceDynamicService
{
    public static function run(array $data)
    {
        $alloweds = Plan::find($data['plan_id'])
            ->alloweds()
            ?->where('rule', 1)
            ->get();

        $totalPrice = 0;
        foreach ($alloweds as $allowed) {
            if ($allowed->required) {
                self::validateTypes($allowed->type, $data);
            }
            $totalPrice += self::calculateMyType($allowed->type, $data);
        }
        return $totalPrice;
    }

    protected static function validateTypes($type, $data)
    {
        if ($type == AllowedEnum::VEICULO->name && empty($data['refer_vehicle_id'])) {
            $response = response(["errors" => ["refer_vehicle_id" => ["Veiculo obrigatório não informado"]]], 422);
            throw new HttpResponseException(
                $response,
            );
        }

        if ($type == AllowedEnum::CHIP->name && empty($data["refer_chip_id"])) {
            $response = response(["errors" => ["refer_chip_id" => ["Chip obrigatório não informado"]]], 422);
            throw new HttpResponseException(
                $response,
            );
        }
    }

    protected static function calculateMyType($type, $data)
    {
        if ($type == AllowedEnum::VEICULO->name && isset($data['refer_vehicle_id'])) {
            $response = response(["errors" => ["refer_vehicle_id" => ["Veiculo não encontrado na nossa base de dados!"]]], 422);
            return FipeVehicle::find($data['refer_vehicle_id'])->ValorReal ?? throw new HttpResponseException(
                $response,
            );
        }

        if ($type == AllowedEnum::CHIP->name && isset($data["refer_chip_id"])) {
            $response = response(["errors" => ["refer_vehicle_id" => ["Chip não encontrado na nossa base de dados!"]]], 422);
            return ChipPrice::find($data['refer_vehicle_id'])->price ?? throw new HttpResponseException(
                $response,
            );
        }

        return 0;
    }
}
