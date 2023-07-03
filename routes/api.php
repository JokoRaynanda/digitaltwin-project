<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RpmController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ServoController;
use App\Http\Controllers\AntaresController;
use App\Http\Controllers\CoolingController;
use App\Http\Controllers\AntarespostController;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\DatasyncController;

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

//API Database
route::apiResource('fuel', FuelController::class); 
route::apiResource('temperature', TemperatureController::class); 
route::apiResource('rpm', RpmController::class); 
route::apiResource('cooling', CoolingController::class); 
route::apiResource('servo', ServoController::class); 
//API Antares
route::apiResource('antares', AntaresController::class);
route::apiResource('datasync', DatasyncController::class);
route::apiResource('antarespost', AntarespostController::class);