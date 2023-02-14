<?php

use Illuminate\Support\Facades\Route;

$model = "chipPrice";
$class = \App\Http\Controllers\Api\ChipPriceController::class;
$crud = "Preço de Chips";

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
                "description" => "Mostrar {$crud}!"
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
    });
