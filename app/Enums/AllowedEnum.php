<?php

declare(strict_types=1);

namespace App\Enums;
enum AllowedEnum : int
{
    use BaseEnum;

    case CHIP            = 1;
    case ANTENA          = 2;
    case RASTREADOR      = 3;
    case VEICULO         = 4;


    public static function returnClass($name)
    {
        if($name=="CHIP") return "\App\Models\Chip";
        if($name=="ANTENA") return "\App\Models\Antenna";
        if($name=="RASTREADOR") return "\App\Models\Tracker";
        if($name=="VEICULO") return "\App\Models\Vehicle";

        return null;
    }
}
