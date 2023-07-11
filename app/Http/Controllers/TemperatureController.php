<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{

    public function index()
    {
        $Temperature = Temperature::all();
        return response()->json([
            'data'=> $Temperature
        ]);
    }

   
    public function store(Request $request)
    {
        $Temperature = Temperature::create([
            'device_id' => $request->device_id,
            'engine_temperature' => $request->engine_temperature,
            'created_at_by_sensor' => $request->created_at_by_sensor
        ]);
        return response()->json([
            'data'=> $Temperature
        ]);
    }

 
    public function show(Temperature $Temperature)
    {
        return response()->json([
            'data'=> $Temperature
        ]);
    }


    public function update(Request $request, Temperature $Temperature)
    {
        $Temperature->device_id = $request->device_id;
        $Temperature->engine_temperature = $request->engine_temperature;
        $Temperature->created_at_by_sensor = $request->created_at_by_sensor;
        $Temperature->save();

        return response()->json([
            'data' => $Temperature
        ]);
    }


    public function destroy($id)
    {
        if(Temperature::where('id',$id)->exists()) {
            $Temperature=Temperature::find($id);
            $Temperature->delete();
            return response()->json([
                'message' => 'data Temperature terhapus'
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
        $Temperature = Temperature::latest('created_at_by_sensor')->take(40)->get();
        $data = [];

        foreach ($Temperature as $value) {
            $data[] = [
                "x" => $value->created_at_by_sensor,
                "y" => $value->engine_temperature
            ];
        }

        return response()->json(["data"=>$data]);
    }
}
