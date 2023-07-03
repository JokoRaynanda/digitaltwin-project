<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AsetSeeder;
use Database\Seeders\SensorDeviceSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AsetSeeder::class);
        $this->call(SensorDeviceSeeder::class);
    }
}
