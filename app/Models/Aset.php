<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table='asets';

    protected $fillable=[
        'engine_name',
        'type',
        'model',
        'cylinder',
        'bore',
        'stroke',
        'engine_capacity',
        'cooling_capacity',
        'rated_output',
        'max_output',
        'fuel',
        'SFOC',
        'volume_tank_capacity',
        'volume_tank_oil',
        'length',
        'height',
        'widht',
        'weight',
        'lube_oil',
        'compression_ratio',
    ];

    public function sensor_device()
    {
        return $this->hasMany(SensorDevice::class, 'aset_id');
    }
}