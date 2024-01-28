<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\FrequentStationsController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\RegisteredTripsAnalyticsController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StationSearchAnalyticsController;
use App\Http\Controllers\WebsiteVisitorsAnalyticsController;
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
Route::resource('frequentstations', FrequentStationsController::class);
Route::resource('destination', DestinationController::class);
Route::resource('registedtrips', RegisteredTripsAnalyticsController::class);
Route::resource('stationssearch', StationSearchAnalyticsController::class);
Route::resource('websitevisitors', WebsiteVisitorsAnalyticsController::class);
