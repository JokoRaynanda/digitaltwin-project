<?php

namespace App\Http\Controllers;

use App\Models\Rpm;
use Illuminate\Http\Request;

class RpmController extends Controller
{

    public function index()
    {
        $rpm = Rpm::all();
        return response()->json([
            'data'=> $rpm
        ]);
    }

    public function store(Request $request)
    {
        $rpm = Rpm::create([
            'device_id' => $request->device_id,
            'engine_rpm' => $request->engine_rpm,
            'created_at_by_sensor' => $request->created_at_by_sensor
        ]);
        return response()->json([
            'data'=> $rpm
        ]);
    }

     public function show(Rpm $rpm)
    {
        return response()->json([
            'data'=> $rpm
        ]);
    }

    public function update(Request $request, Rpm $rpm)
    {
        $rpm->device_id = $request->device_id;
        $rpm->engine_rpm = $request->engine_rpm;
        $rpm->created_at_by_sensor = $request->created_at_by_sensor;
        $rpm->save();

        return response()->json([
            'data' => $rpm
        ]);
    }

   
   public function destroy($id)
    {
        if(Rpm::where('id',$id)->exists()) {
            $rpm=Rpm::find($id);
            $rpm->delete();
            return response()->json([
                'message' => 'data rpm terhapus'
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
        $rpm = Rpm::latest('created_at_by_sensor')->take(20)->get();
        $data = [];

        foreach ($rpm as $value) {
            $data[] = [
                "x" => $value->created_at_by_sensor,
                "y" => $value->engine_rpm
            ];
        }

        return response()->json(["data"=>$data]);
    }
}
