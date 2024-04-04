<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function costs(): BelongsTo
    {
        return $this->belongsTo(Cost::class);
    }

    public function shippingnotes(): HasMany
    {
        return $this->hasManys(ShippingNote::class);
    }

    public static function generateNomorResi()
    {
        // Logika untuk meng-generate nomor resi
        // Misalnya, menggunakan kombinasi tanggal dan angka acak
        return 'MC' . date('Ymd') . mt_rand(1000, 9999);
    }
}
