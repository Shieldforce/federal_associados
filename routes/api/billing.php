<?php

use Illuminate\Support\Facades\Route;

$model = "billing";
$class = \App\Http\Controllers\Api\BillingController::class;
$crud = "Faturas";

Route::prefix("/{$model}")
    ->name("{$model}.")->group(function () use ($class, $model, $crud) {

        Route::post("/monthly", [$class, "monthly"])
            ->name("monthly")
            ->setWheres([
                "group"       => "{$crud}",
                "description" => "Lista de {$crud}!"
            ]);
    });
