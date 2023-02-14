<?php

namespace Database\Seeders;

use App\Models\ChipPrice;
use Illuminate\Database\Seeder;

class ChipPrices extends Seeder
{
    public function run()
    {
        $chipPrice = new ChipPrice();

        // Claro ---------------------------------------------------------
        $claroChipPrices = [
            [
                'name'         => "Chip 1GB",
                'GB'           => 1,
                'allow_voice'  => true,
                'price'        => 30.00,
                'operator_id'  => 1,
            ],
            [
                'name'         => "Chip 20GB",
                'GB'           => 20,
                'allow_voice'  => true,
                'price'        => 70.00,
                'operator_id'  => 1,
            ],
        ];
        foreach ($claroChipPrices as $claroVhipsPrice) {
            $chipPrice->updateOrCreate($claroVhipsPrice, $claroVhipsPrice);
        }


        // Vivo ----------------------------------------------------------
        $vivoChipPrices = [
            [
                'name'         => "Chip 20GB",
                'GB'           => 20,
                'allow_voice'  => true,
                'price'        => 69.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip 40GB",
                'GB'           => 40,
                'allow_voice'  => true,
                'price'        => 99.00,
                'operator_id'  => 2,
            ],
            //---
            [
                'name'         => "Chip 10GB",
                'GB'           => 10,
                'allow_voice'  => false,
                'price'        => 29.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip 40GB",
                'GB'           => 40,
                'allow_voice'  => false,
                'price'        => 50.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip 60GB",
                'GB'           => 60,
                'allow_voice'  => false,
                'price'        => 70.00,
                'operator_id'  => 2,
            ],

            [
                'name'         => "Chip 100GB",
                'GB'           => 100,
                'allow_voice'  => false,
                'price'        => 100.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip 200GB",
                'GB'           => 200,
                'allow_voice'  => false,
                'price'        => 190.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip 300GB",
                'GB'           => 300,
                'allow_voice'  => false,
                'price'        => 280.00,
                'operator_id'  => 2,
            ],
        ];
        foreach ($vivoChipPrices as $vivoVhipsPrice) {
            $chipPrice->updateOrCreate($vivoVhipsPrice, $vivoVhipsPrice);
        }

        // Tim ----------------------------------------------------------
        $timChipPrices = [
            [
                'name'         => "Chip 1GB",
                'GB'           => 1,
                'allow_voice'  => true,
                'price'        => 30.00,
                'operator_id'  => 3,
            ],
            [
                'name'         => "Chip 20GB",
                'GB'           => 20,
                'allow_voice'  => true,
                'price'        => 70.00,
                'operator_id'  => 3,
            ],
            //--
            [
                'name'         => "Chip 500GB",
                'GB'           => 500,
                'allow_voice'  => false,
                'price'        => 150.00,
                'operator_id'  => 3,
            ],
        ];
        foreach ($timChipPrices as $timVhipsPrice) {
            $chipPrice->updateOrCreate($timVhipsPrice, $timVhipsPrice);
        }
    }
}
