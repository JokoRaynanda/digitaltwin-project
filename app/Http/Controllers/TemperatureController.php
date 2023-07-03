<?php

namespace App\Http\Controllers;

use App\Models\temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{

    public function index()
    {
        $temperature = temperature::all();
        return response()->json([
            'data'=> $temperature
        ]);
    }

   
    public function store(Request $request)
    {
        $temperature = temperature::create([
            'device_id' => $request->device_id,
            'engine_temperature' => $request->engine_temperature,
            'created_at_by_sensor' => $request->created_at_by_sensor
        ]);
        return response()->json([
            'data'=> $temperature
        ]);
    }

 
    public function show(temperature $temperature)
    {
        return response()->json([
            'data'=> $temperature
        ]);
    }


    public function update(Request $request, temperature $temperature)
    {
        $temperature->device_id = $request->device_id;
        $temperature->engine_temperature = $request->engine_temperature;
        $temperature->created_at_by_sensor = $request->created_at_by_sensor;
        $temperature->save();

        return response()->json([
            'data' => $temperature
        ]);
    }


    public function destroy(temperature $temperature)
    {
        $temperature->delete();
        return response()->json([
            'message' => 'data temperature terhapus'
        ],204);
    
    }
}
