<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RpmController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ServoController;
use App\Http\Controllers\AntaresController;
use App\Http\Controllers\CoolingController;
use App\Http\Controllers\DatasyncController;
use App\Http\Controllers\AntarespostController;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\AntaresAllDataController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\SensordeviceController;
use App\Models\Aset;
use App\Models\SensorDevice;

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
route::apiResource('device', SensordeviceController::class); 
route::apiResource('aset', AsetController::class); 
//API Antares
route::get('/antares', [AntaresController::class, 'index']);              
route::get('/antaresall', [AntaresAllDataController::class, 'index']);    
route::post('/datasync', [DatasyncController::class, 'store']);           
route::post('/antarespost', [AntarespostController::class, 'store']);      