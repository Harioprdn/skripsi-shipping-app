<?php

namespace App\Filament\Resources\ShippingNoteResource\Pages;

use App\Filament\Resources\ShippingNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShippingNotes extends ListRecords
{
    protected static string $resource = ShippingNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
