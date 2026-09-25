<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    protected $fillable = [
        'location_id',
        'created_by',
        'approved_by',
        'adjustment_number',
        'status',
        'reason',
        'adjusted_at',
    ];

    protected $casts = [
        'adjusted_at' => 'datetime',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items()
    {
        return $this->hasMany(StockAdjustmentItem::class);
    }
}
