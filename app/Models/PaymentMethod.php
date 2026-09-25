<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function salePayments()
    {
        return $this->hasMany(SalePayment::class);
    }

    public function refundPayments()
    {
        return $this->hasMany(RefundPayment::class);
    }
}
