<?php

namespace App\Http\Controllers;

use App\Models\servo;
use Illuminate\Http\Request;

class ServoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servo = servo::all();
        return response()->json([
            'data'=> $servo
        ]);
    }

    public function store(Request $request)
    {
        $servo = servo::create([
            'id_device' => $request->id_device,
            'servo_setrpm' => $request->servo_setrpm,
            'created_at_by_servo' => $request->created_at_by_servo
        ]);
        return response()->json([
            'data'=> $servo
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(servo $servo)
    {
        return response()->json([
            'data'=> $servo
        ]);
    }

    
    public function update(Request $request, servo $servo)
    {
        $servo->device_id = $request->device_id;
        $servo->engine_fuel = $request->engine_fuel;
        $servo->created_at_by_servo = $request->created_at_by_sservo;
        $servo->save();

        return response()->json([
            'data' => $servo
        ]);
    }

    public function destroy($id)
    {
        if(servo::where('id',$id)->exists()) {
            $servo=servo::find($id);
            $servo->delete();
            return response()->json([
                'message' => 'data servo terhapus'
            ],202);
        }
        else
        {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ],202);
        }
    }
}
