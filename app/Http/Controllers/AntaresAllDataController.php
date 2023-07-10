<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AntaresAllDataController extends Controller
{
    private function get_data() 
    {
        $response = Http::withHeaders([
            'X-M2M-Origin' => '5fe73ec991d0d8bb:4bd2da90a6b504c5',
            'Content-Type' => 'application/json',
        ])->acceptJson()->get('https://platform.antares.id:8443/~/antares-cse/antares-id/Digital-Twin/WiFi?ty=4&fu=1&drt=2');
    
        $datas = $response->json();
        $datas = $datas["m2m:list"];
    
        $dataToDB = [];
        $data_collection = array();
    
        foreach($datas as $data) {
            $record = json_decode($data["m2m:cin"]["con"], true);
            if(array_key_exists("device", $record)) $record = json_decode($data["m2m:cin"]["con"], true)["device"]; 
            array_push($data_collection, [
                "date" => $data["m2m:cin"]["ct"],
                "record" => $record,
            ]);
            
            $timestamp = date("Y-m-d H:i:s", strtotime($data["m2m:cin"]["ct"])); 
            array_push($dataToDB, $timestamp);
        }
        $data_collection = collect($data_collection)->sortBy('date')->values()->all();
        return $data_collection;
    }
    
    public function index()
    {
        return response()->json($this->get_data());
    }    

}
