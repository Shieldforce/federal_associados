<?php

declare(strict_types=1);

namespace App\Enums;
enum EndPointsCaixaEnum: int
{
    use BaseEnum;

    case INCLUI_BOLETO = 1;
    case ALTERA_BOLETO = 2;
    case BAIXA_BOLETO = 3;
    case CONSULTA_BOLETO = 4;
}
