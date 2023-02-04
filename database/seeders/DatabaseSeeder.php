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
    }
}
