<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'luminosity',
        'temperature',
        'battery_level',
        'position',
        'pressure',
        'created_at',
        'updated_at',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
