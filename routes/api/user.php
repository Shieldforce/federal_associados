<?php

use Illuminate\Support\Facades\Route;

$model = "user";
$class = \App\Http\Controllers\Api\UserController::class;
$crud = "Usuários";

Route::prefix("/{$model}")
    ->name("{$model}.")->group(function () use ($class, $model, $crud) {

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

        Route::post("saveFile/{{$model}?}", [$class, "saveFile"])
            ->name("saveFile")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Envio de Avatar!"
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

        Route::post("/savePicture/{{$model}}", [$class, "savePicture"])
            ->name("savePicture")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Avatar de {$crud}!"
            ]);
    });
