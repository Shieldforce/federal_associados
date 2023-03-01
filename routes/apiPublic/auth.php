<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/auth/login', [ AuthController::class, "login" ])->name("login");

Route::post('/auth/register', [ AuthController::class, "register" ])->name("register");
