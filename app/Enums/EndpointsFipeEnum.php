<?php

declare(strict_types=1);

namespace App\Enums;

use App\Models\Fipe\FipeBrand;
use App\Models\Fipe\FipeReference;

enum EndpointsFipeEnum : string
{
    use BaseEnum;

    case reference      = "\\App\\Jobs\\Fipe\\ReferenceJob";
    case brand          = "\\App\\Jobs\\Fipe\\BrandJob";

    case model          = "\\App\\Jobs\\Fipe\\ModelJob";

    case year           = "\\App\\Jobs\\Fipe\\YearJob";

    case vehicle        = "\\App\\Jobs\\Fipe\\VehicleJob";

    public static function enpointResolve($name)
    {
        switch ($name) {
            case self::reference->name:
                return "/ConsultarTabelaDeReferencia";
            case self::brand->name:
                return "/ConsultarMarcas";
            case self::model->name:
                return "/ConsultarModelos";
            case self::year->name:
                return "/ConsultarAnoModelo";
            case self::vehicle->name:
                return "/ConsultarModelosAtravesDoAno";
            default:
                return null;
        }
    }

    public static function methodResolve($name)
    {
        switch ($name) {
            case self::reference->name:
                return "POST";
            case self::brand->name:
                return "POST";
            case self::model->name:
                return "POST";
            case self::year->name:
                return "POST";
            case self::vehicle->name:
                return "POST";
            default:
                return null;
        }
    }

    public static function selectType($name, $vehicleType = null)
    {
        if($name == self::reference->name) {
            return [];
        }

        if($name == self::brand->name) {

            $reference = FipeReference::orderBy('created_at', 'desc')->first();
            return [
                "codigoTabelaReferencia" => $reference->Codigo,
                "codigoTipoVeiculo"      => $vehicleType
            ];
        }

        if($name == self::model->name) {
            
            return FipeBrand::get(['Label', 'Value', 'vehicleType'])->toArray();
        }

        return [];
    }
}
