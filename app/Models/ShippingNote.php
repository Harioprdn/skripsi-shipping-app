<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function shippings(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }
}
