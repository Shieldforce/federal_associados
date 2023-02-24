<?php

namespace App\Services\Fipe;

use Illuminate\Support\Facades\Log;

class FipeCurlService
{
    public static function run(string $method, string $enpoint, array $postParams = [])
    {


        $curl = curl_init();
        $data = json_encode($postParams);
        if($enpoint == "/ConsultarTabelaDeReferencia") {
            $contentLength = 'Content-Length: 0';
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => env("API_FIPE") . $enpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => ''.$data.'',
            CURLOPT_HTTPHEADER => array(
                'Host: veiculos.fipe.org.br',
                'Referer: http://veiculos.fipe.org.br',
                'Content-Type: application/json',
                $contentLength ?? "",
                'Cookie: ROUTEID=.13'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        
        return json_decode($response, true);
    }
}
