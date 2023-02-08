<?php

declare(strict_types=1);

namespace App\Enums;
enum OperatorEnum : int
{
    use BaseEnum;

    case CLARO            = 1;
    case TIM              = 2;
    case OI               = 3;
    case ALGAR            = 4;
    case VIVO             = 5;
}
