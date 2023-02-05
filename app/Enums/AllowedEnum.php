<?php

declare(strict_types=1);

namespace App\Enums;

enum AllowedEnum : string
{

    case allowed_item_1      = "chip";
    case allowed_item_2      = "rastreador";
    case allowed_item_3      = "veículo";
    case allowed_item_4      = "antena";

    public static function values($string=null)
    {
        $cases = array_column(self::cases(), "value");

        if($string) {
            $cases = implode(",", $cases);
        }

        return $cases;
    }

    public static function names()
    {
        return array_column(self::cases(), "name");
    }
}
