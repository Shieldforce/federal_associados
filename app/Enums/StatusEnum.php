<?php

declare(strict_types=1);

namespace App\Enums;
enum StatusEnum: int
{
    use BaseEnum;

    case ABERTA = 1;
    case PAGA = 2;
    case CANCELADA = 3;
    
}
