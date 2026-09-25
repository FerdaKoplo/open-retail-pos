<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItemBatch extends Model
{
    protected $fillable = [
        'sale_item_id',
        'product_batch_id',
        'quantity',
    ];

    public function saleItem()
    {
        return $this->belongsTo(SaleItem::class);
    }

    public function productBatch()
    {
        return $this->belongsTo(ProductBatch::class);
    }

    public function refundItemBatches()
    {
        return $this->hasMany(RefundItemBatch::class);
    }
}
