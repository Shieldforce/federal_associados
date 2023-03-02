<?php

namespace Database\Seeders;

use App\Enums\AllowedEnum;
use App\Models\Item\Antenna;
use App\Models\Item\Chip;
use App\Models\Item\Tracker;
use App\Models\Item\Vehicle;
use Illuminate\Database\Seeder;

class Items extends Seeder
{
    public function run()
    {
        $chips = [
            ["number_registration" => rand(100000000000, 200000000000), "type" => AllowedEnum::CHIP->value],
            ["number_registration" => rand(100000000000, 200000000000), "type" => AllowedEnum::CHIP->value],
            ["number_registration" => rand(100000000000, 200000000000), "type" => AllowedEnum::CHIP->value],
            ["number_registration" => rand(100000000000, 200000000000), "type" => AllowedEnum::CHIP->value],
            ["number_registration" => rand(100000000000, 200000000000), "type" => AllowedEnum::CHIP->value],
            ["number_registration" => rand(100000000000, 200000000000), "type" => AllowedEnum::CHIP->value],
        ];

        foreach ($chips as $chip) {
            Chip::updateOrCreate($chip, $chip);
        }

        $antennae = [
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
        ];

        foreach ($antennae as $antenna) {
            Antenna::updateOrCreate($antenna, $antenna);
        }

        $trackers = [
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
        ];

        foreach ($trackers as $tracker) {
            Tracker::updateOrCreate($tracker, $tracker);
        }

        $vehicles = [
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
            ["number_registration" => rand(100000000000, 200000000000)],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::updateOrCreate($vehicle, $vehicle);
        }
    }
}
