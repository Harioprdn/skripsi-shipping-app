<?php

namespace App\Filament\Resources\ShippingNoteResource\Pages;

use App\Filament\Resources\ShippingNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShippingNote extends CreateRecord
{
    protected static string $resource = ShippingNoteResource::class;
}
