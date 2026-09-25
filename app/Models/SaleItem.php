<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'product_name',
        'product_sku',
        'quantity',
        'unit_price',
        'discount_amount',
        'tax_amount',
        'line_total',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function batches()
    {
        return $this->hasMany(SaleItemBatch::class);
    }

    public function refundItems()
    {
        return $this->hasMany(RefundItem::class);
    }
}
