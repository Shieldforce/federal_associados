<?php

namespace App\Services\Caixa;

class Information
{
    public static function getData()
    {
        return
            [
                'url_consulta'  => env("WEB_SERVICE_CAIXA_CONSULTA"),
                'url_operacoes' => env("WEB_SERVICE_CAIXA_OPERACOES"),
                'codigoCedente' => env("CODIGO_CEDENTE_CAIXA"),
                'cnpj'          => env("CNPJ_CAIXA"),
                'numeroAgencia' => env("NUMERO_AGENCIA_CAIXA"),
            ];
    }
}
