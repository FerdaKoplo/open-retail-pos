<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'sale_id',
        'location_id',
        'processed_by',
        'refund_number',
        'subtotal',
        'tax_total',
        'total',
        'reason',
        'status',
        'refunded_at',
    ];

    protected $casts = [
        'refunded_at' => 'datetime',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function items()
    {
        return $this->hasMany(RefundItem::class);
    }

    public function payments()
    {
        return $this->hasMany(RefundPayment::class);
    }
}
