<?php

namespace App\Http\Controllers;

use App\Models\SensorDevice;
use Illuminate\Http\Request;

class SensordeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SensorDevice = SensorDevice::all();
        return response()->json([
            'data'=> $SensorDevice
        ]);
    }

    
    public function store(Request $request)
    {
        $SensorDevice = SensorDevice::create([
            'name_device'=> $request->name_device,
            'model'=> $request->model,
            'operating_voltage'=> $request->operating_voltage,
            'operating_current'=> $request->operating_current,
            'length'=> $request->length,
            'width'=> $request->width,
            'height'=> $request->height,

           
        ]);
        return response()->json([
            'data'=> $SensorDevice
        ]);
    }


    public function show(SensorDevice $SensorDevice)
    {
        return response()->json([
            'data'=> $SensorDevice
        ]);
    }

   
    public function update(Request $request, SensorDevice $SensorDevice)
    {   
        $SensorDevice->name_device = $request->name_device;
        $SensorDevice->model = $request->model;
        $SensorDevice->operating_voltage = $request->operating_voltage;
        $SensorDevice->operating_current = $request->operating_current;
        $SensorDevice->length=  $request->length;
        $SensorDevice->width = $request->width;
        $SensorDevice->height = $request->height;
        $SensorDevice->save();

        return response()->json([
            'data' => $SensorDevice
        ]);
    }


    public function destroy($id)
    {
        if(SensorDevice::where('id',$id)->exists()) {
            $SensorDevice=SensorDevice::find($id);
            $SensorDevice->delete();
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
