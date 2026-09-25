<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'location_id',
        'product_id',
        'product_batch_id',
        'movement_type',
        'quantity_delta',
        'unit_cost',
        'source_type',
        'source_id',
        'notes',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productBatch()
    {
        return $this->belongsTo(ProductBatch::class);
    }
}
