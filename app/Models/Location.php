<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'code',
        'address',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function registers()
    {
        return $this->hasMany(Register::class);
    }

    public function inventoryStocks()
    {
        return $this->hasMany(InventoryStock::class);
    }
}
