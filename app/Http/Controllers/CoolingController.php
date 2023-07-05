<?php

namespace App\Http\Controllers;

use App\Models\cooling;
use Illuminate\Http\Request;

class CoolingController extends Controller
{
    
    public function index()
    {
        $cooling = cooling::all();
        return response()->json([
            'data'=> $cooling
        ]);
    }


    public function store(Request $request)
    {
        $cooling = cooling::create([
            'device_id' => $request->device_id,
            'engine_cooling' => $request->engine_cooling,
            'created_at_by_sensor' => $request->created_at_by_sensor
        ]);
        return response()->json([
            'data'=> $cooling
        ]);
    }


    public function show(cooling $cooling)
    {
        return response()->json([
            'data'=> $cooling
        ]);
    }


    public function update(Request $request, cooling $cooling)
    {
        $cooling->device_id = $request->device_id;
        $cooling->engine_cooling = $request->engine_cooling;
        $cooling->created_at_by_sensor = $request->created_at_by_sensor;
        $cooling->save();

        return response()->json([
            'data' => $cooling
        ]);
    }


    public function destroy($id)
    {
        if(cooling::where('id',$id)->exists()) {
            $cooling=cooling::find($id);
            $cooling->delete();
            return response()->json([
                'message' => 'data cooling terhapus'
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
        $cooling = cooling::latest('created_at_by_sensor')->take(10)->get();
        $data = [];

        foreach ($cooling as $value) {
            $data[] = [
                "x" => $value->created_at_by_sensor,
                "y" => $value->engine_cooling
            ];
        }

        return response()->json(["data"=>$data]);
    }
}