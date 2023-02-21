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
                'name'         => "Chip (Internet e Voz) 1GB | R$ 30,00",
                'GB'           => 1,
                'allow_voice'  => true,
                'price'        => 30.00,
                'operator_id'  => 1,
            ],
            [
                'name'         => "Chip (Internet e Voz) 20GB | R$ 70,00",
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
                'name'         => "Chip (Internet e Voz) 20GB | R$ 69,00",
                'GB'           => 20,
                'allow_voice'  => true,
                'price'        => 69.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip (Internet e Voz) 40GB | R$ 99,00",
                'GB'           => 40,
                'allow_voice'  => true,
                'price'        => 99.00,
                'operator_id'  => 2,
            ],
            //---
            [
                'name'         => "Chip (Internet) 10GB | R$ 29,00",
                'GB'           => 10,
                'allow_voice'  => false,
                'price'        => 29.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip (Internet) 40GB | R$ 50,00",
                'GB'           => 40,
                'allow_voice'  => false,
                'price'        => 50.00,
                'operator_id'  => 2,
            ],
            [
                'name'         => "Chip (Internet) 60GB | R$ 70,00",
                'GB'           => 60,
                'allow_voice'  => false,
                'price'        => 70.00,
                'operator_id'  => 2,
            ],

            [
                'name'         => "Chip (Internet) 100GB | R$ 100,00",
                'GB'           => 100,
                'allow_voice'  => false,
                'price'        => 100.00,
                'operator_id'  => 2,
                'allow_antenna' => true,

            ],
            [
                'name'         => "Chip (Internet) 200GB | R$ 190,00",
                'GB'           => 200,
                'allow_voice'  => false,
                'price'        => 190.00,
                'operator_id'  => 2,
                'allow_antenna' => true,

            ],
            [
                'name'         => "Chip (Internet) 300GB | R$ 280,00",
                'GB'           => 300,
                'allow_voice'  => false,
                'price'        => 280.00,
                'operator_id'  => 2,
                'allow_antenna' => true,

            ],
            [
                'name'         => "Chip (Internet) 400GB | R$ 380,00",
                'GB'           => 400,
                'allow_voice'  => false,
                'price'        => 380.00,
                'operator_id'  => 2,
                'allow_antenna' => true,

            ],
            [
                'name'         => "Chip (Internet) 500GB | R$ 480,00",
                'GB'           => 500,
                'allow_voice'  => false,
                'price'        => 480.00,
                'operator_id'  => 2,
                'allow_antenna' => true,

            ],
        ];
        foreach ($vivoChipPrices as $vivoVhipsPrice) {
            $chipPrice->updateOrCreate($vivoVhipsPrice, $vivoVhipsPrice);
        }

        // Tim ----------------------------------------------------------
        $timChipPrices = [
            [
                'name'         => "Chip (Internet e Voz) 1GB | R$ 30,00",
                'GB'           => 1,
                'allow_voice'  => true,
                'price'        => 30.00,
                'operator_id'  => 3,
            ],
            [
                'name'         => "Chip (Internet e Voz) 20GB | R$ 70,00",
                'GB'           => 20,
                'allow_voice'  => true,
                'price'        => 70.00,
                'operator_id'  => 3,
            ],
            //--
            [
                'name'         => "Chip (Internet) 500GB | R$ 500,00",
                'GB'           => 500,
                'allow_voice'  => false,
                'price'        => 150.00,
                'operator_id'  => 3,
                'allow_antenna' => true,

            ],
        ];
        foreach ($timChipPrices as $timVhipsPrice) {
            $chipPrice->updateOrCreate($timVhipsPrice, $timVhipsPrice);
        }
    }
}
