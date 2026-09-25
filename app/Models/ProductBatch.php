<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    protected $fillable = [
        'product_id',
        'batch_number',
        'expiry_date',
        'received_at',
        'is_active',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'received_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function batchStocks()
    {
        return $this->hasMany(BatchStock::class);
    }
}
