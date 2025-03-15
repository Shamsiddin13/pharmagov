<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitOfMeasurement extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the products that use this unit of measurement.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
