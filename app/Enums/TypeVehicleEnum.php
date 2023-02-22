<?php

declare(strict_types=1);

namespace App\Enums;
enum TypeVehicleEnum : int
{
    use BaseEnum;

    case carro            = 1;
    case moto             = 2;
    case caminhao         = 3;
}
