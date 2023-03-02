<?php

namespace App\Http\Controllers\Api;

use App\Enums\EndPointsCaixaEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\BillingCreateRequest;
use App\Jobs\BillingMonthlyPayJob;
use App\Services\Caixa\ExtraService;
use App\Services\Caixa\Information;
use App\Services\Caixa\Registro;
use App\Services\Caixa\XmlConverterService;

class BillingController extends Controller
{
    public function monthly(BillingCreateRequest $request)
    {
        $extraService = new ExtraService();
        $information = Information::getData();
        $our_number = $extraService->generateOurNumber("16111161611161");
        $dueDate = "2022-03-04";
        $nominalValue = "100.00";
        $arrayDadosHash = array(
            'codigoCedente'  => $information['codigoCedente'],
            'nossoNumero'    => $our_number,
            'dataVencimento' => $dueDate,
            'valorNominal'   => $nominalValue,
            'cnpj'           => $information['cnpj']
        );
        $authentication = ExtraService::_generateHashAuthentication($arrayDadosHash);
        $xmlReturn = XmlConverterService::XmlToParse(app_path() . "/Services/Caixa/XmlTemplate/inclui_boleto_completo.xml", [
            "HEADER|VERSAO"                                 => '1.0',
            "HEADER|AUTENTICACAO"                           => $authentication,
            "HEADER|USUARIO_SERVICO"                        => 'SGCBS02P',
            "HEADER|OPERACAO"                               => EndPointsCaixaEnum::INCLUI_BOLETO->value,
            "HEADER|SISTEMA_ORIGEM"                         => 'SIGCB',
            "HEADER|UNIDADE"                                => $information["numeroAgencia"],
            "HEADER|DATA_HORA"                              => date('YmdHis'),
            "dataVencimento"                                => $dueDate,
            "valorNominal"                                  => $nominalValue,
            "CODIGO_BENEFICIARIO"                           => $information["codigoCedente"],
            "TITULO|NOSSO_NUMERO"                           => $our_number,
            "TITULO|NUMERO_DOCUMENTO"                       => "3",
            "TITULO|DATA_VENCIMENTO"                        => "4",
            "TITULO|VALOR"                                  => "5",
            "TITULO|TIPO_ESPECIE"                           => "6",
            "TITULO|FLAG_ACEITE"                            => "7",
            "TITULO|DATA_EMISSAO"                           => "8",
            "TITULO|JUROS_MORA|TIPO"                        => "9",
            "TITULO|JUROS_MORA|VALOR"                       => "10",
            "TITULO|VALOR_ABATIMENTO"                       => "11",
            "TITULO|POS_VENCIMENTO|ACAO"                    => "12",
            "TITULO|POS_VENCIMENTO|NUMERO_DIAS"             => "13",
            "TITULO|CODIGO_MOEDA"                           => "14",
            "TITULO|PAGADOR|CPF"                            => "15",
            "TITULO|PAGADOR|NOME"                           => "16",
            "TITULO|PAGADOR|ENDERECO|LOGRADOURO"            => "17",
            "TITULO|PAGADOR|ENDERECO|BAIRRO"                => "18",
            "TITULO|PAGADOR|ENDERECO|CIDADE"                => "19",
            "TITULO|PAGADOR|ENDERECO|UF"                    => "20",
            "TITULO|PAGADOR|ENDERECO|CEP"                   => "21",
            "TITULO|MULTA|DATA"                             => "22",
            "TITULO|MULTA|VALOR"                            => "23",
            "TITULO|DESCONTOS|DESCONTO|1|DATA"              => "24",
            "TITULO|DESCONTOS|DESCONTO|1|PERCENTUAL"        => "25",
            "TITULO|DESCONTOS|DESCONTO|2|DATA"              => "26",
            "TITULO|DESCONTOS|DESCONTO|2|PERCENTUAL"        => "27",
            "TITULO|DESCONTOS|DESCONTO|3|DATA"              => "28",
            "TITULO|DESCONTOS|DESCONTO|3|PERCENTUAL"        => "29",
            "TITULO|FICHA_COMPENSACAO|MENSAGENS|1|MENSAGEM" => "30",
            "TITULO|FICHA_COMPENSACAO|MENSAGENS|2|MENSAGEM" => "31",
            "TITULO|RECIBO_PAGADOR|MENSAGENS|1|MENSAGEM"    => "32",
            "TITULO|RECIBO_PAGADOR|MENSAGENS|2|MENSAGEM"    => "33",
            "TITULO|RECIBO_PAGADOR|MENSAGENS|3|MENSAGEM"    => "34",
            "TITULO|RECIBO_PAGADOR|MENSAGENS|4|MENSAGEM"    => "36",
            "TITULO|PAGAMENTO|QUANTIDADE_PERMITIDA"         => "37",
            "TITULO|PAGAMENTO|TIPO"                         => "38",
            "TITULO|PAGAMENTO|VALOR_MINIMO"                 => "39",
            "TITULO|PAGAMENTO|VALOR_MAXIMO"                 => "40",
        ]);
        $registro = Registro::run($xmlReturn);

        dd($registro);


        //$validated = $request->validated();
        //BillingMonthlyPayJob::dispatch($validated["reference"]);

        //return response()->json(true);
    }
}
