<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingNote extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function drivers(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function costs(): BelongsTo
    {
        return $this->belongsTo(Cost::class);
    }

    public function vehicles(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function shippingnoteitems(): HasMany
    {
        return $this->hasMany(ShippingNoteItem::class);
    }
}
