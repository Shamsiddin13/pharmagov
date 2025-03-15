<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Substance extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];

    /**
     * Get the products for the substance.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
