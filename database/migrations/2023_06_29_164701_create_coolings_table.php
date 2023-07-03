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
        Schema::create('coolings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id')->nullable(); 
            $table->foreign('device_id')->references('id')->on('sensor_devices');
            $table->string('engine_cooling');
            $table->timestamp('created_at_by_sensor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coolings');
    }
};
