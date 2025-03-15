<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'substance_id',
        'unit_of_measurement_id',
        'unit_price',
        'is_available'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_available' => 'boolean'
    ];

    /**
     * Get the substance that owns the product.
     */
    public function substance(): BelongsTo
    {
        return $this->belongsTo(Substance::class);
    }

    /**
     * Get the unit of measurement that owns the product.
     */
    public function unitOfMeasurement(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasurement::class);
    }

    /**
     * Get the warehouse items for the product.
     */
    public function warehouseItems(): HasMany
    {
        return $this->hasMany(WarehouseItem::class);
    }
}
