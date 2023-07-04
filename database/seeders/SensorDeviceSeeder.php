<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sensor_devices')->insert([
            'aset_id'=> '1',
            'name_device'=> 'Sensor Ultrasonic',
            'model'=> 'HC-SR04',
            'operating_voltage'=> '5VDC',
            'operating_current'=> '15mA',
            'length'=> '20,63',
            'width'=> '20,63',
            'height'=> '15,87',
        ]);
        DB::table('sensor_devices')->insert([
            'aset_id'=> '1',
            'name_device'=> 'Sensor Flow Rate',
            'model'=> 'YF-S201',
            'operating_voltage'=> '5V',
            'operating_current'=> '15mA',
            'length'=> '60',
            'width'=> '34',
            'height'=> '34',
        ]);
        DB::table('sensor_devices')->insert([
            'aset_id'=> '1',
            'name_device'=> 'Sensor Thermo Couple',
            'model'=> 'Max6675ISA',
            'operating_voltage'=> '5,5V',
            'operating_current'=> '15mA',
            'length'=> '5',
            'width'=> '5,8',
            'height'=> '1,27',
        ]);
        DB::table('sensor_devices')->insert([
            'aset_id'=> '1',
            'name_device'=> 'Motor Servo',
            'model'=> 'MG996',
            'operating_voltage'=> '4,8V',
            'operating_current'=> '500mA',
            'length'=> '40,7',
            'width'=> '19,7',
            'height'=> '42,9',
        ]);
        DB::table('sensor_devices')->insert([
            'aset_id'=> '1',
            'name_device'=> 'Sensor RPM',
            'model'=> 'KY-032',
            'operating_voltage'=> '5V',
            'operating_current'=> '20mA',
            'length'=> '32',
            'width'=> '28',
            'height'=> '1',
        ]);
        

    }
}