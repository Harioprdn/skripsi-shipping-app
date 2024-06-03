<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ShippingNoteItem extends Pivot
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    /**
     * @var string
     */
    protected $table = 'shipping_note_items';

    public function shippings(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    public function shippingnotes(): BelongsTo
    {
        return $this->belongsTo(ShippingNote::class);
    }
}
