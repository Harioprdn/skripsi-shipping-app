<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cost extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function shippings(): HasMany
    {
        return $this->hasMany(Shipping::class);
    }
}
