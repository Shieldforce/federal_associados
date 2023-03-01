<?php

use App\Enums\AllowedEnum;
use App\Enums\OperatorEnum;
use Illuminate\Support\Facades\Route;


Route::get('/enums/operators', function () {
    return response()->json(["data" => OperatorEnum::names()], 200);
});

Route::get('/enums/getPlanItens', function () {
    return response()->json(["data" => AllowedEnum::names()], 200);
});

