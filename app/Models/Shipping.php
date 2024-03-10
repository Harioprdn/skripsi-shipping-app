<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function items(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
