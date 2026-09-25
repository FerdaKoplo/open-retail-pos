<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HardwareDevice extends Model
{
    protected $fillable = [
        'agent_id',
        'register_id',
        'name',
        'type',
        'connection_type',
        'configuration',
        'is_active',
    ];

    protected $casts = [
        'configuration' => 'array',
        'is_active' => 'boolean',
    ];

    public function agent()
    {
        return $this->belongsTo(HardwareAgent::class, 'agent_id');
    }

    public function register()
    {
        return $this->belongsTo(Register::class);
    }
}
