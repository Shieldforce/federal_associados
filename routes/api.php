<?php

use App\Enums\OperatorEnum;
use App\Enums\PlanItemsEnum;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BenefitController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [ AuthController::class, "login" ])->name("login");

Route::get('/enums/operators', function () {
    return response()->json(["data" => OperatorEnum::names()], 200);
});

Route::get('/enums/getPlanItens', function () {
    return response()->json(["data" => PlanItemsEnum::names()], 200);
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/verifyToken', [\App\Http\Controllers\Api\AuthController::class, "verifyToken"])
        ->name("verifyToken")
        ->setWheres([
            "group" => "Autenticação",
            "description" => "Checagem de Token"
        ]);

    Route::middleware(['acl'])->group(function () {

        foreach (File::allFiles(__DIR__ . '/api') as $route_file) {
            require $route_file->getPathname();
        }

    }
    );

});
