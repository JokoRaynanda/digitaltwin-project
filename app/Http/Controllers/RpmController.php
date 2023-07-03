<?php

namespace App\Http\Controllers;

use App\Models\rpm;
use Illuminate\Http\Request;

class RpmController extends Controller
{

    public function index()
    {
        $rpm = rpm::all();
        return response()->json([
            'data'=> $rpm
        ]);
    }

    public function store(Request $request)
    {
        $rpm = rpm::create([
            'device_id' => $request->device_id,
            'engine_rpm' => $request->engine_rpm,
            'created_at_by_sensor' => $request->created_at_by_sensor
        ]);
        return response()->json([
            'data'=> $rpm
        ]);
    }

     public function show(rpm $rpm)
    {
        return response()->json([
            'data'=> $rpm
        ]);
    }

    public function update(Request $request, rpm $rpm)
    {
        $rpm->device_id = $request->device_id;
        $rpm->engine_rpm = $request->engine_rpm;
        $rpm->created_at_by_sensor = $request->created_at_by_sensor;
        $rpm->save();

        return response()->json([
            'data' => $rpm
        ]);
    }

   
   public function destroy(rpm $rpm)
    {
        $rpm->delete();
        return response()->json([
            'message' => 'data rpm terhapus'
        ],204);
    }
}
