<?php

namespace App\Http\Controllers;

use App\Models\Rpm;
use App\Models\Fuel;
use App\Models\Servo;
use App\Models\Cooling;
use App\Models\Temperature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DatasyncController extends Controller
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

        foreach ($datas as $data) {
            $record = json_decode($data["m2m:cin"]["con"], true);
            if (array_key_exists("device", $record)) $record = json_decode($data["m2m:cin"]["con"], true)["device"];
            array_push($data_collection, [
                "date" => $data["m2m:cin"]["ct"],
                "exhaust" => $record['exhaust'] ?? 0,
                "fuel" => $record['fuel'] ?? 0,
                "cooling" => $record['cooling'] ?? 0,
                "servo" => $record['servo'] ?? 0,
                "rpm" => $record['rpm'] ?? 0,
                "record" => $record,
            ]);

            $timestamp = date("Y-m-d H:i:s", strtotime($data["m2m:cin"]["ct"]));
            array_push($dataToDB, $timestamp);
        }
        
        $data_collection = collect($data_collection)->sortBy('date')->values()->all();
        return $data_collection;
    }

    

    public function store()
    {
        DB::beginTransaction();
        try {
            $datas = $this->get_data();

            foreach ($datas as $item) {
                // sync fuel data
                $latesttimefuels = Fuel::where('created_at_by_sensor', $item['date'])->first();
                if (!$latesttimefuels) {
                    Fuel::create([
                        "device_id" => 1,
                        "engine_fuel" => $item['fuel'],
                        "created_at_by_sensor" => $item['date'],
                    ]);
                } 

                // sync cooling data
                $latestCooling = Cooling::where('created_at_by_sensor', $item['date'])->first();
                if(!$latestCooling){
                    Cooling::create([
                        "device_id" => 2,
                        "engine_cooling" => $item['cooling'],
                        "created_at_by_sensor" => $item['date'],
                    ]);
                } 

                // sync temperature data
                $latestTemp = Temperature::where('created_at_by_sensor', $item['date'])->first();
                if(!$latestTemp){
                    Temperature::create([
                        "device_id" => 3,
                        "engine_temperature" => $item['exhaust'],
                        "created_at_by_sensor" => $item['date'],
                    ]);
                } 

                // sync servo data
                $latestServo = Servo::where('created_at_by_servo', $item['date'])->first();
                if(!$latestServo){
                    Servo::create([
                        "device_id" => 4,
                        "servo_setrpm" => $item['servo'],
                        "created_at_by_servo" => $item['date'],
                    ]);
                } 

                // sync rpm data
                $latestRpm = Rpm::where('created_at_by_sensor', $item['date'])->first();
                if(!$latestRpm){
                    Rpm::create([
                        "device_id" => 5,
                        "engine_rpm" => $item['rpm'],
                        "created_at_by_sensor" => $item['date'],
                    ]);
                }   
            }

            DB::commit();
            return response()->json([
                "status" => true,
                "message" => "Data berhasil disyncronkan ke database.",
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                "status" => true,
                "message" => "Terjadi error dengan pesan " . $th->getMessage(),
            ], 200);
        };
    }
}
