<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundItemBatch extends Model
{
    protected $fillable = [
        'refund_item_id',
        'sale_item_batch_id',
        'product_batch_id',
        'quantity',
    ];

    public function refundItem()
    {
        return $this->belongsTo(RefundItem::class);
    }

    public function saleItemBatch()
    {
        return $this->belongsTo(SaleItemBatch::class);
    }

    public function productBatch()
    {
        // Aliased to match the typo in the migration column name
        return $this->belongsTo(ProductBatch::class, 'procut_batch_id');
    }
}
