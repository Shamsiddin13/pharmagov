<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    protected $table = 'warehouse';

    protected $fillable = [
        'user_id',
        'section_id',
        'paragraph_id',
        'polyclinic_id',
        'supplier_id',
        'demand_letter_id',
        'invoice_id',
        'date',
        'total_amount'
    ];

    protected $casts = [
        'date' => 'date',
        'total_amount' => 'decimal:2'
    ];

    /**
     * Get the user that owns the warehouse record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the section that owns the warehouse record.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Get the paragraph that owns the warehouse record.
     */
    public function paragraph(): BelongsTo
    {
        return $this->belongsTo(Paragraph::class);
    }

    /**
     * Get the polyclinic that owns the warehouse record.
     */
    public function polyclinic(): BelongsTo
    {
        return $this->belongsTo(Polyclinic::class);
    }

    /**
     * Get the supplier that owns the warehouse record.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the demand letter that owns the warehouse record.
     */
    public function demandLetter(): BelongsTo
    {
        return $this->belongsTo(DemandLetter::class);
    }

    /**
     * Get the invoice that owns the warehouse record.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the warehouse items for the warehouse record.
     */
    public function warehouseItems(): HasMany
    {
        return $this->hasMany(WarehouseItem::class);
    }
}
