<?php

use Illuminate\Support\Facades\Route;

$model = "public";
$class = \App\Http\Controllers\ApiPublic\PublicController::class;
$crud = "Rotas Publicas";

Route::prefix("/{$model}")
    ->name("{$model}.")->group(function () use ($class, $model, $crud) {

        Route::get("/getPlans", [$class, "getPlans"])
            ->name("getPlans")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Lista publica de planos!"
            ]);

        Route::get("/getChipPrices", [$class, "getChipPrices"])
            ->name("getChipPrices")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Lista publica de Preços de Chips!"
            ]);
    });
