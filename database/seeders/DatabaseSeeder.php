<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(Roles::class);
        $this->call(Permissions::class);
        $this->call(User::class);
        $this->call(Operators::class);
        $this->call(ChipPrices::class);
        $this->call(Plans::class);
        $this->call(Items::class);
        $this->call(Orders::class);
    }
}
