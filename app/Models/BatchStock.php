<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchStock extends Model
{
    protected $fillable = [
        'location_id',
        'product_batch_id',
        'quantity',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function productBatch()
    {
        return $this->belongsTo(ProductBatch::class);
    }
}
