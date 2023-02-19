<?php

use Illuminate\Support\Facades\Route;

$model = "order";
$class = \App\Http\Controllers\Api\OrderController::class;
$crud = "Pedidos";

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
                "description" => "Mostrar Cliente!"
            ]);

        Route::post("", [$class, "store"])
            ->name("create")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Criação de {$crud}!"
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

        Route::post("/auditorOfChipsActives", [$class, "auditorOfChipsActives"])
            ->name("auditorOfChipsActives")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Auditoria de Chips Ativos ({$crud})!"
            ]);
    });
