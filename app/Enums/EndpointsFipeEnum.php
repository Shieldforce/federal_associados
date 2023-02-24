<?php

declare(strict_types=1);

namespace App\Enums;

use App\Models\Fipe\FipeBrand;
use App\Models\Fipe\FipeModel;
use App\Models\Fipe\FipeReference;
use App\Models\Fipe\FipeYear;

enum EndpointsFipeEnum : string
{
    use BaseEnum;

    case reference      = "\\App\\Jobs\\Fipe\\ReferenceJob";
    case brand          = "\\App\\Jobs\\Fipe\\BrandJob";

    case model          = "\\App\\Jobs\\Fipe\\ModelJob";

    case year           = "\\App\\Jobs\\Fipe\\YearJob";

    case vehicle        = "\\App\\Jobs\\Fipe\\VehicleJob";

    public static function enpointResolve($name): ?string
    {
        return match ($name) {
            self::reference->name => "/ConsultarTabelaDeReferencia",
            self::brand->name => "/ConsultarMarcas",
            self::model->name => "/ConsultarModelos",
            self::year->name => "/ConsultarAnoModelo",
            self::vehicle->name => "/ConsultarValorComTodosParametros",
            default => null,
        };
    }

    public static function methodResolve($name): ?string
    {
        return match ($name) {
            self::brand->name, self::model->name, self::year->name, self::vehicle->name, self::reference->name => "POST",
            default => null,
        };
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

        if($name == self::year->name) {

                return FipeModel::get(['codigoModelo', 'codigoMarca','codigoTabelaReferencia', 'codigoTipoVeiculo'])->toArray();
        }

        if($name == self::vehicle->name) {

            return FipeYear::get([
                "codigoTabelaReferencia",
                "codigoTipoVeiculo",
                "codigoMarca",
                "codigoModelo",
                "Label",
                "ano",
                "codigoTipoCombustivel",
                "anoModelo"])->toArray();
        }

        return [];
    }
}
