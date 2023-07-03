<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AntarespostController extends Controller
{

    public function index()
    {
        $response = Http::withHeaders([
            'X-M2M-Origin' => '5fe73ec991d0d8bb:4bd2da90a6b504c5',
            'Content-Type' => 'application/json',
        ])->acceptJson()->get('https://platform.antares.id:8443/~/antares-cse/antares-id/DigitalTwin2023/monitor?ty=4&fu=1&drt=2');

        $datas = $response->json();
        $datas = $datas["m2m:list"];

        $dataToDB = [];
        $data_collection = array();

        foreach ($datas as $data) {
            $record = json_decode($data["m2m:cin"]["con"], true);
            if (array_key_exists("device", $record)) $record = json_decode($data["m2m:cin"]["con"], true)["device"];
            array_push($data_collection, [
                "date" => $data["m2m:cin"]["ct"],
                "record" => $record,
            ]);

            $timestamp = date("Y-m-d H:i:s", strtotime($data["m2m:cin"]["ct"]));
            array_push($dataToDB, $timestamp);
        }
        $data_collection = collect($data_collection)->first();
        return $data_collection;
    }

    public function store(Request $request)
    {
        $servo_state = $request->servo ?? 0;
        if ($servo_state > 180) {
            $servo_state = 180;
        }
        if ($servo_state < 0) {
            $servo_state = 0;
        }

        $data = array(
            'm2m:cin' => array(
                'con' => '{"device":{"modelMotor":"Motor Diesel 4 langkah horizontal","jumlahSilinder":"1","dimensi":"672 x 330,5 x 0.00","bahanBakar":"Solar","rasioKompresi":"17","sistemPendinginan":"Hopper","setRpm":"1","exhaust":"215","fuel":"120","cooling":"80","rpm":"5","servo":"' . $servo_state . '"}}'
            )
        );
        $url = 'https://platform.antares.id:8443/~/antares-cse/antares-id/DigitalTwin2023/monitor';

        $headers = array(
            'X-M2M-Origin: 5fe73ec991d0d8bb:4bd2da90a6b504c5',
            'Content-Type: application/json;ty=4',
            'Accept: application/json'
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return response()->json([
            'response' => $response,
        ]);
    }
}
