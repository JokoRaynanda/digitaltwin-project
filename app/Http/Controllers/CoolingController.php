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


    public function destroy(cooling $cooling)
    {
        $cooling->delete();
        return response()->json([
            'message' => 'data cooling terhapus'
        ],204);
    }
}
