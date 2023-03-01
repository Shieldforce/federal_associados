<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

foreach (File::allFiles(__DIR__ . '/apiPublic') as $route_file) {
    require $route_file->getPathname();
}

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
    });

});
