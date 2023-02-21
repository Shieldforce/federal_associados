<?php

namespace Database\Seeders;

use App\Models\Allowed;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Allowds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allowd = new Allowed();
        $esmeraldaid = Plan::where("name", "Plano Esmeralda")->first()->id;
        $perolaid = Plan::where("name", "Plano Perola")->first()->id;
        $prataid = Plan::where("name", "Plano Prata")->first()->id;
        $rubiid = Plan::where("name", "Plano Rubi")->first()->id;

//        ESMERALDA
        $allowd1 = [
            "plan_id"   => $esmeraldaid,
            "type"      => 3,
            "value"     => 50,
            "rule"      => 0,
            "required"  => 1,
        ];

        $allowd->updateOrCreate($allowd1,$allowd1);


//        PEROLA
        $allowd2= [
            "plan_id"   => $perolaid,
            "type"      => 1,
            "value"     => 0,
            "rule"      => 1,
            "required"  => 1,
        ];

        $allowd->updateOrCreate($allowd2,$allowd2);

        $allowd3= [
            "plan_id"   => $perolaid,
            "type"      => 2,
            "value"     => 20,
            "rule"      => 0,
            "required"  => 0,
        ];

        $allowd->updateOrCreate($allowd3,$allowd3);

        //        PRATA
        $allowd5= [
            "plan_id"   => $prataid,
            "type"      => 4,
            "value"     => 0,
            "rule"      => 1,
            "required"  => 1,
        ];

        $allowd->updateOrCreate($allowd5,$allowd5);

        $allowd6= [
            "plan_id"   => $prataid,
            "type"      => 3,
            "value"     => 0,
            "rule"      => 0,
            "required"  => 1,
        ];

        $allowd->updateOrCreate($allowd6,$allowd6);

        //        RUBI
        $allowd7= [
            "plan_id"   => $rubiid,
            "type"      => 4,
            "value"     => 0,
            "rule"      => 1,
            "required"  => 1,
        ];

        $allowd->updateOrCreate($allowd7,$allowd7);

        $allowd8= [
            "plan_id"   => $rubiid,
            "type"      => 3,
            "value"     => 0,
            "rule"      => 0,
            "required"  => 1,
        ];

        $allowd->updateOrCreate($allowd8,$allowd8);

        $allowd9= [
            "plan_id"   => $rubiid,
            "type"      => 1,
            "value"     => 0,
            "rule"      => 0,
            "required"  => 0,
        ];

        $allowd->updateOrCreate($allowd9,$allowd9);

    }
}
