<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class DemandLetter extends Model
{
    protected $fillable = [
        'reference_number',
        'section_id',
        'letter_date'
    ];

    protected $casts = [
        'letter_date' => 'date'
    ];

    /**
     * Get the section that owns the demand letter.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Get the warehouse records for the demand letter.
     */
    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->reference_number) {
                $nextVal = DB::scalar('SELECT nextval(\'demand_letters_ref_seq\')');
                $model->reference_number = "№-" . $nextVal;
            }
        });
    }
}
