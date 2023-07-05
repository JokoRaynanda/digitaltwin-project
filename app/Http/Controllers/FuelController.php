<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    
    //Display a listing of the resource.
    public function index()
    {
        $fuel = Fuel::all();
        return response()->json([
            'data'=> $fuel
        ]);
    }
    
    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $fuel = Fuel::create([
            'device_id' => $request->device_id,
            'engine_fuel' => $request->engine_fuel,
            'created_at_by_sensor' => $request->created_at_by_sensor
        ]);
        return response()->json([
            'data'=> $fuel
        ]);
    }

    //Display the specified resource.
     public function show(Fuel $fuel)
    {
        return response()->json([
            'data'=> $fuel
        ]);
    }
 
    //Update the specified resource in storage.
    public function update(Request $request, Fuel $fuel)
    {
        $fuel->device_id = $request->device_id;
        $fuel->engine_fuel = $request->engine_fuel;
        $fuel->created_at_by_sensor = $request->created_at_by_sensor;
        $fuel->save();

        return response()->json([
            'data' => $fuel
        ]);
    }
  
    //Remove the specified resource from storage.
    public function destroy($id)
    {
        if(fuel::where('id',$id)->exists()) {
            $fuel=fuel::find($id);
            $fuel->delete();
            return response()->json([
                'message' => 'data fuel terhapus'
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
        $fuel = Fuel::latest('created_at_by_sensor')->take(10)->get();
        $data = [];

        foreach ($fuel as $value) {
            $data[] = [
                "x" => $value->created_at_by_sensor,
                "y" => $value->engine_fuel
            ];
        }

        return response()->json(["data"=>$data]);
    }
}
