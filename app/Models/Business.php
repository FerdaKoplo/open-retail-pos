<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'legal_name',
        'phone',
        'email',
        'address',
        'currency',
        'timezone',
        'settings',
        'is_active',
    ];

    protected $casts = [
        'settings' => 'array', // Automatically decodes JSON
        'is_active' => 'boolean',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

}
