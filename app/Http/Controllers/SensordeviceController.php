<?php

namespace App\Http\Controllers;

use App\Models\sensordevice;
use Illuminate\Http\Request;

class SensordeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sensordevice = sensordevice::all();
        return response()->json([
            'data'=> $sensordevice
        ]);
    }

    
    public function store(Request $request)
    {
        $sensordevice = sensordevice::create([
            'name_device'=> $request->name_device,
            'model'=> $request->model,
            'operating_voltage'=> $request->operating_voltage,
            'operating_current'=> $request->operating_current,
            'length'=> $request->length,
            'width'=> $request->width,
            'height'=> $request->height,

           
        ]);
        return response()->json([
            'data'=> $sensordevice
        ]);
    }


    public function show(sensordevice $sensordevice)
    {
        return response()->json([
            'data'=> $sensordevice
        ]);
    }

   
    public function update(Request $request, sensordevice $sensordevice)
    {   
        $sensordevice->name_device = $request->name_device;
        $sensordevice->model = $request->model;
        $sensordevice->operating_voltage = $request->operating_voltage;
        $sensordevice->operating_current = $request->operating_current;
        $sensordevice->length=  $request->length;
        $sensordevice->width = $request->width;
        $sensordevice->height = $request->height;
        $sensordevice->save();

        return response()->json([
            'data' => $sensordevice
        ]);
    }


    public function destroy($id)
    {
        if(sensordevice::where('id',$id)->exists()) {
            $sensordevice=sensordevice::find($id);
            $sensordevice->delete();
            return response()->json([
                'message' => 'data sensor device terhapus'
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
