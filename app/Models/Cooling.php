<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooling extends Model
{
    use HasFactory;

    protected $fillable=[
        'device_id',
        'engine_cooling',
        'created_at_by_sensor',
    ];

    public function SensorDevice()
    {
        return $this->belongsTo(SensorDevice::class, 'device_id');
    }
}
