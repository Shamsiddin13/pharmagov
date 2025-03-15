<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        'name',
        'department_head',
        'head_nurse'
    ];

    /**
     * Get the demand letters for the section.
     */
    public function demandLetters(): HasMany
    {
        return $this->hasMany(DemandLetter::class);
    }

    /**
     * Get the warehouse records for the section.
     */
    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
}
