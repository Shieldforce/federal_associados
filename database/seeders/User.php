<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $test = [
            'name' => 'testUser',
            'email' => 'test@example.com',
            'password' => "federal@2023",
            "cpf" => "11111111110"
        ];

        $testPass = $test;
        unset($test["password"]);

        $test = \App\Models\User::updateOrCreate($test, $testPass);
        $test->roles()->sync([Role::whereIn("name", ["SA"])->first()->id]);

        // -----------
        $sa = [
            'name' => 'SA',
            'email' => 'sa@example.com',
            'password' => "federal@2023",
            "cpf" => "11111111111"
        ];

        $saPass = $sa;
        unset($sa["password"]);

        $sa = \App\Models\User::updateOrCreate($sa, $saPass);
        $sa->roles()->sync([Role::whereIn("name", ["SA"])->first()->id]);

        // -----------
        $parceiro = [
            'name' => 'Parceiro',
            'email' => 'parceiro@example.com',
            'password' => "federal@2023",
            "cpf" => "11111111112"

        ];

        $parceiroPass = $parceiro;
        unset($parceiro["password"]);

        $parceiro = \App\Models\User::updateOrCreate($parceiro, $parceiroPass);
        $parceiro->roles()->sync([Role::whereIn("name", ["Parceiro"])->first()->id]);

        // -----------
        $usuario = [
            'name' => 'Cliente',
            'email' => 'usuario@example.com',
            'password' => "federal@2023",
            "cpf" => "11111111113"
        ];


        $usuarioPass = $usuario;
        unset($usuario["password"]);

        $parceiro = \App\Models\User::updateOrCreate($usuario, $usuarioPass);
        $parceiro->roles()->sync([Role::whereIn("name", ["Cliente"])->first()->id]);

        // -----------
        $funcionario = [
            'name' => 'Funcionário',
            'email' => 'funcionario@example.com',
            'password' => "federal@2023",
            "cpf" => "11111111114"
        ];


        $funcionarioPass = $funcionario;
        unset($funcionario["password"]);

        $parceiro = \App\Models\User::updateOrCreate($funcionario, $funcionarioPass);
        $parceiro->roles()->sync([Role::whereIn("name", ["Funcionário"])->first()->id]);
    }
}
