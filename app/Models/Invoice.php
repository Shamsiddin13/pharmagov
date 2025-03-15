<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    protected $fillable = [
        'reference_number',
        'polyclinic_id',
        'invoice_date',
        'total_amount'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'total_amount' => 'decimal:2'
    ];

    /**
     * Get the polyclinic that owns the invoice.
     */
    public function polyclinic(): BelongsTo
    {
        return $this->belongsTo(Polyclinic::class);
    }

    /**
     * Get the warehouse records for the invoice.
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
                $nextVal = DB::scalar('SELECT nextval(\'invoices_ref_seq\')');
                $model->reference_number = "№-" . $nextVal;
            }
        });
    }
}
