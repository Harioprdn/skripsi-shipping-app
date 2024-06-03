<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipping extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'paid' => 'boolean',
    ];

    public function items(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function costs(): BelongsTo
    {
        return $this->belongsTo(Cost::class);
    }

    public function shippingnoteitems(): HasMany
    {
        return $this->hasMany(ShippingNoteItem::class);
    }
}
