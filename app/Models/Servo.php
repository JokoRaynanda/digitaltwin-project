<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servo extends Model
{
    use HasFactory;
    protected $fillable=[
        'device_id',
        'servo_setrpm',
        'created_at_by_servo',
    ];

    public function SensorDevice()
    {
        return $this->belongsTo(SensorDevice::class, 'device_id');
    }
}
