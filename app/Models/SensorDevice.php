<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorDevice extends Model
{
    use HasFactory;

    protected $table='sensor_devices';

    protected $fillable=[
        'aset_id',
        'name_device',
        'model',
        'operating_voltage',
        'operating_current',
        'length',
        'width',
        'height',  
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }

    public function rpm()
    {
        return $this->hasMany(Rpm::class, 'device_id');
    }
    public function cooling()
    {
        return $this->hasMany(Cooling::class, 'device_id');
    }
    public function servo()
    {
        return $this->hasMany(Servo::class, 'device_id');
    }
    public function fuel()
    {
        return $this->hasMany(Fuel::class, 'device_id');
    }
    public function temperature()
    {
        return $this->hasMany(Temperature::class, 'device_id');
    }

}
