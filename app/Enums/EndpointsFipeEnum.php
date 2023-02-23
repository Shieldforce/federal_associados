<?php

declare(strict_types=1);

namespace App\Enums;
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
}
