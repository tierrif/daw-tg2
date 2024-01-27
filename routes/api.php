<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\StationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:sanctum')->group( function () {

//});

Route::resource('line', LineController::class);
Route::resource('station', StationController::class);
Route::resource('balance', BalanceController::class);
