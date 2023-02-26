<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class Orders extends Seeder
{
    public function run()
    {
        Order::updateOrCreate([
            "plan_id"          => 1,
            "client_id"        => 1,
            "obs"              => "teste",
            "value"            => 10.50,
            "status"           => "teste",
            "dueDay"           => '10',
            "reference"        => "teste",
            "type"             => "teste",
            "activationDate"   => '2023-02-14',
            "cancellationDate" => '2023-02-14',
        ]);
    }
}
