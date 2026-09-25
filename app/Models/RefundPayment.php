<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundPayment extends Model
{
    protected $fillable = [
        'refund_id',
        'payment_method_id',
        'amount',
        'reference_number',
        'refunded_at',
    ];

    protected $casts = [
        'refunded_at' => 'datetime',
    ];

    public function refund()
    {
        return $this->belongsTo(Refund::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
