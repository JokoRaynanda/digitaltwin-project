<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aset_id')->nullable(); 
            $table->foreign('aset_id')->references('id')->on('asets'); 
            $table->string('name_device');
            $table->string('model');
            $table->string('operating_voltage');
            $table->string('operating_current');
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_devices');
    }
};
