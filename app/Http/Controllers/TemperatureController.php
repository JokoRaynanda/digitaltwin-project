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


    public function destroy($id)
    {
        if(temperature::where('id',$id)->exists()) {
            $temperature=temperature::find($id);
            $temperature->delete();
            return response()->json([
                'message' => 'data temperature terhapus'
            ],202);
        }
        else
        {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ],202);
        }
    }

    public function get_chart()
    {
        $temperature = temperature::latest('created_at_by_sensor')->take(10)->get();
        $data = [];

        foreach ($temperature as $value) {
            $data[] = [
                "x" => $value->created_at_by_sensor,
                "y" => $value->engine_temperature
            ];
        }

        return response()->json(["data"=>$data]);
    }
}
