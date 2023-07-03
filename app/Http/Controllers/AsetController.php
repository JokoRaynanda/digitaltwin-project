<?php

namespace App\Http\Controllers;

use App\Models\aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset = aset::all();
        return response()->json([
            'data'=> $aset
        ]);
    }

    public function store(Request $request)
    {
        $aset= aset::create([
            'engine_name' => $request->engine_name,
            'type' => $request->type,
            'model' => $request->model,
            'cylinder'=> $request->cylinder,
            'bore'=> $request->bore,
            'stroke'=> $request->stroke,
            'engine_capacity'=> $request->engine_capacity,
            'cooling_capacity'=> $request->cooling_capacity,
            'rated_output'=> $request->rated_output,
            'max_output'=> $request->max_output,
            'fuel'=> $request->fuel,
            'SFOC'=> $request->SFOC,
            'volume_tank_capacity'=> $request->volume_tank_capacity,
            'volume_tank_oil'=> $request->volume_tank_oil,
            'length'=> $request->length,
            'height'=> $request->height,
            'widht'=> $request->widht,
            'weight'=> $request->weight,
            'lube_oil'=> $request->lube_oil,
            'compression_ratio'=> $request->compression_ratio,
        ]);
        return response()->json([
            'data'=> $aset
        ]);
    }


    public function show(aset $aset)
    {
        return response()->json([
            'aset'=> $aset
        ]);
    }


    public function update(Request $request, aset $aset)
    {
        $aset->engine_name = $request->engine_name;
        $aset->type = $request->type;
        $aset->model = $request->model;
        $aset->cylinder = $request->cylinder;
        $aset->bore = $request->bore;
        $aset->stroke = $request->stroke;
        $aset->engine_capacity = $request->engine_capacity;
        $aset->cooling_capacity = $request->cooling_capacity;
        $aset->rated_output = $request->rated_output;
        $aset->max_output = $request->max_output;
        $aset->fuel = $request->fuel;
        $aset->SFOC = $request->SFOC;
        $aset->volume_tank_capacity = $request->volume_tank_capacity;
        $aset->volume_tank_oil = $request->volume_tank_oil;
        $aset->length = $request->length;
        $aset->height = $request->height;
        $aset->widht = $request->widht;
        $aset->weight = $request->weight;
        $aset->lube_oil = $request->lube_oil;
        $aset->compression_ratio = $request->compression_ratio;        
        $aset->save();

        return response()->json([
            'aset' => $aset
        ]);
    }
    


    public function destroy(aset $aset)
    {
        $aset->delete();
        return response()->json([
            'message' => 'data aset terhapus'
        ],204);
    }
}
