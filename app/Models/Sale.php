<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'location_id',
        'register_id',
        'cashier_id',
        'invoice_number',
        'subtotal',
        'discount_total',
        'tax_total',
        'grand_total',
        'status',
        'idempotency_key',
        'notes',
        'sold_at',
    ];

    protected $casts = [
        'sold_at' => 'datetime',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function register()
    {
        return $this->belongsTo(Register::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function payments()
    {
        return $this->hasMany(SalePayment::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}
