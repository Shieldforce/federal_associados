<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Seeder;

class Operators extends Seeder
{
    public function run()
    {
        $operator = new Operator();

        $operator1 = [
            'name' => "claro",
        ];
        $operator->updateOrCreate($operator1, $operator1);


        $operator2 = [
            'name' => "vivo",
        ];
        $operator->updateOrCreate($operator2, $operator2);


        $operator3 = [
            'name' => "tim",
        ];
        $operator->updateOrCreate($operator3, $operator3);
    }
}
