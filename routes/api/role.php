<?php

use Illuminate\Support\Facades\Route;

$model = "role";
$class = \App\Http\Controllers\Api\RoleController::class;
$crud = "Funções";

Route::prefix("/{$model}")
    ->name("{$model}.")->group(function () use ($class, $model, $crud) {

        Route::get("/listRolesPublic", [$class, "listRolesPublic"])
            ->name("listRolesPublic")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Lista de {$crud}/Grupos"
            ]);

        Route::get("", [$class, "index"])
            ->name("index")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Lista de {$crud}!"
            ]);

        Route::get("/{{$model}?}", [$class, "show"])
            ->name("show")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Mostrar Usuário!"
            ]);

        Route::post("", [$class, "store"])
            ->name("create")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Criação de {$crud}!"
            ]);

        Route::post("/updateProfile", [$class, "updateProfile"])
            ->name("updateProfile")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Atualização do perfil!"
            ]);

        Route::put("/{{$model}?}", [$class, "update"])
            ->name("update")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Edição de {$crud}!"
            ]);

        Route::delete("/{{$model}?}", [$class, "destroy"])
            ->name("destroy")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Exclusão de {$crud}!"
            ]);
    });
