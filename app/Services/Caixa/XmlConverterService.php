<?php

namespace App\Services\Caixa;

use SimpleXMLElement;

class XmlConverterService
{
    public static function XmlToArray(string $pathFileContent, $in = [])
    {
        $xmlObject = simplexml_load_file($pathFileContent);
        $json = json_encode($xmlObject);
        $json = self::XmlToReplace($json, $in);
        $array = json_decode($json, true);

        $information = Information::getData();
        $arrayDadosHash = array(
            'codigoCedente'  => $information['codigoCedente'],
            'nossoNumero'    => $in['TITULO|NOSSO_NUMERO'],
            'dataVencimento' => $in['dataVencimento'],
            'valorNominal'   => $in['valorNominal'],
            'cnpj'           => $information['cnpj']
        );

        $authentication = ExtraService::_generateHashAuthentication($arrayDadosHash);

        $array = array(
            'soapenv:Body' => array(
                'manutencaocobrancabancaria:SERVICO_ENTRADA' => array(
                    'sibar_base:HEADER' => array(
                        'VERSAO'          => '1.0',
                        'AUTENTICACAO'    => $authentication,
                        'USUARIO_SERVICO' => $in["USUARIO_SERVICO"], // SGCBS02P - Produção | SGCBS01D - Desenvolvimento
                        'OPERACAO'        => $in["OPERACAO"], // Implementado apenas para inclusão
                        'SISTEMA_ORIGEM'  => 'SIGCB',
                        'UNIDADE'         => $information['numeroAgencia'],
                        'DATA_HORA'       => date('YmdHis')
                    ),
                    "DADOS"             => $array["DADOS"],
                ),
            )
        );
        return $array;
    }

    public static function XmlToParse(string $pathFileContent, $in = []): SimpleXMLElement
    {
        $xmlObject = file_get_contents($pathFileContent);
        $xml = self::XmlToReplace($xmlObject, $in);
        $xml = simplexml_load_string($xml);
        return $xml;
    }

    public static function XmlToReplace(string $jsonContent, $in = [])
    {
        $includes = [];

        foreach ($in as $index => $value) {
            if (str_contains($jsonContent, $index)) {
                $includes[$index]["index"] = "{" . $index . "}";
                $includes[$index]["value"] = $value;
            }
        }

        return str_replace(
            array_column($includes, "index"),
            array_column($includes, "value"),
            $jsonContent
        );
    }
}
