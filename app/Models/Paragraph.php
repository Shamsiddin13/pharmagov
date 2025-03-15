<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paragraph extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Get the warehouse records for the paragraph.
     */
    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
}
