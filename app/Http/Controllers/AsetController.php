<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Aset = Aset::all();
        return response()->json([
            'data'=> $Aset
        ]);
    }

    public function store(Request $request)
    {
        $Aset= Aset::create([
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
            'data'=> $Aset
        ]);
    }


    public function show(Aset $Aset)
    {
        return response()->json([
            'Aset'=> $Aset
        ]);
    }


    public function update(Request $request, Aset $Aset)
    {
        $Aset->engine_name = $request->engine_name;
        $Aset->type = $request->type;
        $Aset->model = $request->model;
        $Aset->cylinder = $request->cylinder;
        $Aset->bore = $request->bore;
        $Aset->stroke = $request->stroke;
        $Aset->engine_capacity = $request->engine_capacity;
        $Aset->cooling_capacity = $request->cooling_capacity;
        $Aset->rated_output = $request->rated_output;
        $Aset->max_output = $request->max_output;
        $Aset->fuel = $request->fuel;
        $Aset->SFOC = $request->SFOC;
        $Aset->volume_tank_capacity = $request->volume_tank_capacity;
        $Aset->volume_tank_oil = $request->volume_tank_oil;
        $Aset->length = $request->length;
        $Aset->height = $request->height;
        $Aset->widht = $request->widht;
        $Aset->weight = $request->weight;
        $Aset->lube_oil = $request->lube_oil;
        $Aset->compression_ratio = $request->compression_ratio;        
        $Aset->save();

        return response()->json([
            'Aset' => $Aset
        ]);
    }
    


    public function destroy($id)
    {
        if(Aset::where('id',$id)->exists()) {
            $Aset=Aset::find($id);
            $Aset->delete();
            return response()->json([
                'message' => 'data Aset terhapus'
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
