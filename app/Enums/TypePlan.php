<?php

declare(strict_types=1);

namespace App\Enums;

enum TypePlan : string
{
    case type_plan_1         = "Benefício";
    case type_plan_2         = "Proteção";

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
