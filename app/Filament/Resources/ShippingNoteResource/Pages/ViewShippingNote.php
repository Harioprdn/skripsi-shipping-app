<?php

namespace App\Filament\Resources\ShippingNoteResource\Pages;

use App\Filament\Resources\ShippingNoteResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Pages\Actions\Modal\Actions\ButtonAction;
use Filament\Resources\Pages\ViewRecord;

class ViewShippingNote extends ViewRecord
{
    protected static string $resource = ShippingNoteResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['id'] = auth()->id();

        return $data;
    }

    protected function getActions(): array
    {
        return [
            Action::make('view_pdf')
                ->label('Lihat Surat Jalan')
                ->url(fn ($record) => route('drivernote.pdf', $record->id))
                ->openUrlInNewTab(),
        ];
    }
}
