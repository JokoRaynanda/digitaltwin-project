<?php

namespace App\Http\Controllers;

use App\Models\Servo;
use Illuminate\Http\Request;

class ServoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Servo = Servo::all();
        return response()->json([
            'data'=> $Servo
        ]);
    }

    public function store(Request $request)
    {
        $Servo = Servo::create([
            'id_device' => $request->id_device,
            'servo_setrpm' => $request->servo_setrpm,
            'created_at_by_servo' => $request->created_at_by_servo
        ]);
        return response()->json([
            'data'=> $Servo
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Servo $Servo)
    {
        return response()->json([
            'data'=> $Servo
        ]);
    }

    
    public function update(Request $request, Servo $Servo)
    {
        $Servo->device_id = $request->device_id;
        $Servo->servo_setrpm = $request->servo_setrpm;
        $Servo->created_at_by_servo = $request->created_at_by_servo;
        $Servo->save();

        return response()->json([
            'data' => $Servo
        ]);
    }

    public function destroy($id)
    {
        if(Servo::where('id',$id)->exists()) {
            $Servo=Servo::find($id);
            $Servo->delete();
            return response()->json([
                'message' => 'data Servo terhapus'
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
