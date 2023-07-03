<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asets')->insert([
            'engine_name' => 'Yanmar',
            'type' => 'TF-65 H',
            'model' => '4 Stroke',
            'cylinder'=> '1',
            'bore'=> '78',
            'stroke'=> '80',
            'engine_capacity'=> '382',
            'cooling_capacity'=> 'Radiator',
            'rated_output'=> '5,5/2200',
            'max_output'=> '6,5/2200',
            'fuel'=> 'Diesel Fuel',
            'SFOC'=> '178',
            'volume_tank_capacity'=> '7,1',
            'volume_tank_oil'=> '1,8',
            'length'=> '607,5',
            'height'=> '311,5',
            'widht'=> '469',
            'weight'=> '67,5',
            'lube_oil'=> 'SAE 40 CC/DD',
            'compression_ratio'=> '18,1',
        ]);
    }
}
