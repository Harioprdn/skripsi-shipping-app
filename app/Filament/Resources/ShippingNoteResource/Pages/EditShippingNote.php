<?php

namespace App\Filament\Resources\ShippingNoteResource\Pages;

use App\Filament\Resources\ShippingNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShippingNote extends EditRecord
{
    protected static string $resource = ShippingNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
