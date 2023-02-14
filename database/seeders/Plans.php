<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class Plans extends Seeder
{
    public function run()
    {
        Plan::updateOrCreate([
            "name"            => "Plano Pérola",
            "description"     => "Plano Pérola",
        ]);

        Plan::updateOrCreate([
            "name"            => "Plano Rubi",
            "description"     => "Plano Rubi",
        ]);

        Plan::updateOrCreate([
            "name"            => "Plano Diamante",
            "description"     => "Plano Diamante",
        ]);
    }
}
