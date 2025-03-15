<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    /**
     * Get the warehouse records for the supplier.
     */
    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
}
