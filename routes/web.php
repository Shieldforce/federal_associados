<?php

use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("https://documenter.getpostman.com/view/24662898/2s935oL4JK");
});

Route::get('/test', [ testController::class, 'test' ])->name('test');
Route::get('/test2', [ testController::class, 'test2' ])->name('test2');
