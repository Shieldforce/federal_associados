<?php

namespace App\Services\Order;

use App\Enums\AllowedEnum;
use App\Enums\StatusEnum;
use App\Models\Item\Item;
use App\Models\Order;

class CreateItemsService
{
    public static function run(Order $order, array $data)
    {
        if (isset($data["refer_chip_id"])) {
            Item::create([
                "itemable_type"      => AllowedEnum::returnClass(AllowedEnum::CHIP->name),
                //"itemable_id"        => "",
                "type"               => AllowedEnum::CHIP->value,
                "status"             => StatusEnum::ABERTA->value,
                "order_id"           => $order->id,
                "reference_price_id" => $data["refer_chip_id"]
            ]);
        }

        if (isset($data["refer_vehicle_id"])) {
            Item::create([
                "itemable_type"      => AllowedEnum::returnClass(AllowedEnum::VEICULO->name),
                //"itemable_id"        => "",
                "type"               => AllowedEnum::VEICULO->value,
                "status"             => StatusEnum::ABERTA->value,
                "order_id"           => $order->id,
                "reference_price_id" => $data["refer_vehicle_id"]
            ]);
        }

        if (isset($data["fixed_antenna_id"])) {
            Item::create([
                "itemable_type"      => AllowedEnum::returnClass(AllowedEnum::ANTENA->name),
                //"itemable_id"        => "",
                "type"               => AllowedEnum::ANTENA->value,
                "status"             => StatusEnum::ABERTA->value,
                "order_id"           => $order->id,
                "reference_price_id" => $data["fixed_antenna_id"]
            ]);
        }

        if (isset($data["fixed_tracker_id"])) {
            Item::create([
                "itemable_type"      => AllowedEnum::returnClass(AllowedEnum::RASTREADOR->name),
                //"itemable_id"        => "",
                "type"               => AllowedEnum::RASTREADOR->value,
                "status"             => StatusEnum::ABERTA->value,
                "order_id"           => $order->id,
                "reference_price_id" => $data["fixed_tracker_id"]
            ]);
        }

        if (isset($data["fixed_chip_id"])) {
            Item::create([
                "itemable_type"      => AllowedEnum::returnClass(AllowedEnum::CHIP->name),
                //"itemable_id"        => "",
                "type"               => AllowedEnum::CHIP->value,
                "status"             => StatusEnum::ABERTA->value,
                "order_id"           => $order->id,
                "reference_price_id" => $data["fixed_chip_id"]
            ]);
        }
    }
}
