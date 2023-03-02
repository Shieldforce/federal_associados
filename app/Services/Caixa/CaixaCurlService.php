<?php

namespace App\Services\Caixa;

use App\Enums\EndPointsCaixaEnum;

class CaixaCurlService
{
    public static function run(EndPointsCaixaEnum $endPointsCaixaEnum, $xml)
    {
        $curl = curl_init();
        $informationGetData = Information::getData();
        $url = $informationGetData['url_operacoes'];


        dd($url, $xml, $endPointsCaixaEnum->name);

        if ($endPointsCaixaEnum->name == "CONSULTA_BOLETO") $url = $informationGetData['url_consulta'];
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $xml,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/xml',
                "SOAPAction: '{$endPointsCaixaEnum->name}'"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

}
