<?php

namespace App\Services\Caixa;

use App\Enums\EndPointsCaixaEnum;
use SimpleXMLElement;

class Registro
{
    public static function run(SimpleXMLElement $xml)
    {
        return CaixaCurlService::run(
            EndPointsCaixaEnum::INCLUI_BOLETO,
            $xml,
        );
    }
}
