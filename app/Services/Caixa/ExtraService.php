<?php

namespace App\Services\Caixa;

class ExtraService
{

    public static function _generateHashAuthentication(array $arrayDadosHash)
    {
        $numeroParaHash = preg_replace('/[^A-Za-z0-9]/', '', str_pad($arrayDadosHash['codigoCedente'], 7, '0', STR_PAD_LEFT) .
                $arrayDadosHash['nossoNumero'] .
                strftime('%d%m%Y', strtotime($arrayDadosHash['dataVencimento']))) .
            str_pad(preg_replace('/[^0-9]/', '', $arrayDadosHash['valorNominal']), 15, '0', STR_PAD_LEFT) .
            str_pad($arrayDadosHash['cnpj'], 14, '0', STR_PAD_LEFT);

        $autenticacao = base64_encode(hash('sha256', $numeroParaHash, true));
        return $autenticacao;
    }

    public function generateOurNumber($our_number)
    {
        $return = $this->numberFormat('1', 1, 0) . $this->numberFormat('4', 1, 0) .
            $this->numberFormat('000', 3, 0) . $this->numberFormat('000', 3, 0) .
            $this->numberFormat($our_number, 9, 0);
        return $return;
    }

    public function generateOurNumberComplet($our_number)
    {
        $our_number_value = $this->numberFormat('1', 1, 0) . $this->numberFormat('4', 1, 0) .
            $this->numberFormat('000', 3, 0) . $this->numberFormat('000', 3, 0) .
            $this->numberFormat($our_number, 9, 0);
        $return = $our_number_value . $this->verificationDigitOurNumber($our_number_value);
        return $return;
    }

    public function numberFormat($number, $loop, $insert, $type = "geral")
    {
        if ($type == "geral") {
            $number = str_replace(",", "", $number);
            while (strlen($number) < $loop) {
                $number = $insert . $number;
            }
        }
        if ($type == "valor") {

            $number = str_replace(",", "", $number);
            while (strlen($number) < $loop) {
                $number = $insert . $number;
            }
        }
        if ($type == "convenio") {
            while (strlen($number) < $loop) {
                $number = $number . $insert;
            }
        }
        return $number;
    }

    public function verificationDigitOurNumber($number)
    {
        $rest2 = $this->module_11($number, 9, 1);
        $digit = 11 - $rest2;
        if ($digit == 10 || $digit == 11) {
            $dv = 0;
        } else {
            $dv = $digit;
        }
        return $dv;
    }

    public function module_11($num, $base = 9, $r = 0)
    {
        $sum = 0;
        $factory = 2;
        for ($i = strlen($num); $i > 0; $i--) {
            $numbers[$i] = substr($num, $i - 1, 1);
            $partial[$i] = $numbers[$i] * $factory;
            $sum += $partial[$i];
            if ($factory == $base) {
                $factory = 1;
            }
            $factory++;
        }
        if ($r == 0) {
            $sum *= 10;
            $digit = $sum % 11;
            if ($digit == 10) {
                $digit = 0;
            }
            return $digit;
        } elseif ($r == 1) {
            $rest = $sum % 11;
            return $rest;
        }
    }
}
