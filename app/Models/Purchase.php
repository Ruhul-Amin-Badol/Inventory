<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'supplier_id',
        'notes',
        
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Get the supplier that owns the purchase.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the purchase items associated with the purchase.
     */
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Accessor for total, calculates the sum of all purchase item total prices.
     */
    public function getTotalAttribute()
    { 
        return $this->purchaseItems->sum('total_price');
    }

    /**
     * Accessor for due, calculates the difference between total and paid.
     */
    public function getDueAttribute()
    {
        return $this->total - ($this->paid ?? 0); 
    }
}
