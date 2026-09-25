<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'tax_rate_id',
        'sku',
        'name',
        'description',
        'cost_price',
        'selling_price',
        'unit',
        'track_stock',
        'track_batch',
        'track_expiry',
        'is_active',
    ];

    protected $casts = [
        'track_stock' => 'boolean',
        'track_batch' => 'boolean',
        'track_expiry' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function taxRate()
    {
        return $this->belongsTo(TaxRate::class);
    }

    public function barcodes()
    {
        return $this->hasMany(ProductBarcode::class);
    }

    public function batches()
    {
        return $this->hasMany(ProductBatch::class);
    }
}
