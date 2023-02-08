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
}
