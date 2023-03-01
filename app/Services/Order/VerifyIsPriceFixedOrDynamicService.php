<?php

namespace App\Services\Order;

class VerifyIsPriceFixedOrDynamicService
{
    public static function run($data)
    {
        $priceDynamic = CalcPriceDynamicService::run($data);
        $priceFixed = CalcPriceFixedService::run($data);
        return $priceDynamic + $priceFixed;
    }
}
