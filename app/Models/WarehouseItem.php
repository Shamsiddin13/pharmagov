<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseItem extends Model
{
    protected $fillable = [
        'unit_price',
        'quantity',
        'sub_total',
        'warehouse_id',
        'product_id'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity' => 'float',
        'sub_total' => 'decimal:2'
    ];

    /**
     * Get the warehouse that owns the warehouse item.
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the product that owns the warehouse item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
