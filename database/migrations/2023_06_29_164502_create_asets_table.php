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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('engine_name');
            $table->string('type');
            $table->string('model');
            $table->string('cylinder');
            $table->string('bore');
            $table->string('stroke');
            $table->string('engine_capacity');
            $table->string('cooling_capacity');
            $table->string('rated_output');
            $table->string('max_output');
            $table->string('fuel');
            $table->string('SFOC');
            $table->string('volume_tank_capacity');
            $table->string('volume_tank_oil');
            $table->string('length');
            $table->string('height');
            $table->string('widht');
            $table->string('weight');
            $table->string('lube_oil');
            $table->string('compression_ratio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
