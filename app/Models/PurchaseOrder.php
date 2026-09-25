<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
protected $fillable = [
        'supplier_id',
        'location_id',
        'created_by',
        'po_numbers',
        'status',
        'subtotal',
        'tax_total',
        'grand_total',
        'ordered_at',
        'expected_at',
        'notes',
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
        'expected_at' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}

