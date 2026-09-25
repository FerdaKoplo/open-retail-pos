<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HardwareAgent extends Model
{
    protected $fillable = [
        'location_id',
        'name',
        'agent_key_hash',
        'hostname',
        'platform',
        'version',
        'status',
        'last_seen_at',
        'is_active',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function devices()
    {
        return $this->hasMany(HardwareDevice::class, 'agent_id');
    }
}
