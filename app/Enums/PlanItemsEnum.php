<?php

declare(strict_types=1);

namespace App\Enums;
enum PlanItemsEnum : int
{
    use BaseEnum;

    case CHIPS            = 1;
    case ANTENAS          = 2;
    case RASTREADORES     = 3;
    case VEICULOS         = 4;
}
