<?php

namespace App\Services;

use App\Models\Fipe\FipeVehicle;

class CalcPercentageCarService
{

    private FipeVehicle $fipeVehicle;

    public static function run(FipeVehicle $fipeVehicle, $data)
    {
        if (!isset($fipeVehicle->ValorReal)) {
            return false;
        }
        $baseValueAdhesion = 100.00;
        $result = $fipeVehicle->ValorReal * ($data["adhesion_percentage"] / 100);
        return $baseValueAdhesion + $result;
    }
}
