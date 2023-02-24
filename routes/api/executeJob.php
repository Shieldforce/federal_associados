<?php

use Illuminate\Support\Facades\Route;

$model = "executeJob";
$class = \App\Http\Controllers\Api\ExecuteJobController::class;
$crud = "jobs";

Route::prefix("/{$model}")
    ->name("{$model}.")->group(function () use ($class, $model, $crud) {

        Route::post("/run", [$class, "run"])
            ->name("run")
            ->setWheres([
                "group" => "{$crud}",
                "description" => "Execução dos ({$crud})!"
            ]);
    });
