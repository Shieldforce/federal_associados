<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class Roles extends Seeder
{
    public function run()
    {
        $role = new Role();
        $role1 = [
            'name' => "SA",
            "description" => "Administrador Geral do sistema!",
        ];
        $role->updateOrCreate($role1, $role1);


        $role2 = [
            'name' => "Parceiro",
            "description" => "Parceiros do sistema!",
        ];
        $role->updateOrCreate($role2, $role2);


        $role3 = [
            'name' => "Cliente",
            "description" => "Clientes do sistema!",
        ];
        $role->updateOrCreate($role3, $role3);

        $role4 = [
            'name' => "Funcionário",
            "description" => "Funcionários do sistema!",
        ];
        $role->updateOrCreate($role4, $role4);
    }
}
