<?php

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
use Illuminate\Support\Facades\Route;


$model = "fipePublic";
$class = \App\Http\Controllers\ApiPublic\FipeApiConsultController::class;
$crud = "Rotas Publicas";

Route::prefix("/{$model}")
    ->name("{$model}.")->group(function () use ($class, $model, $crud) {

        Route::get("/getBrands", [$class, "getBrands"])
            ->name("getBrands")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Lista publica de planos!"
            ]);

        Route::get("/getModels", [$class, "getModels"])
            ->name("getModels")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Lista publica de Preços de Chips!"
            ]);
    });
