<?php

namespace App\Filament\Resources\ShippingResource\Pages;

use App\Filament\Resources\ShippingResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Pages\Actions\Modal\Actions\ButtonAction;
use Filament\Resources\Pages\ViewRecord;

class ViewShipping extends ViewRecord
{
    protected static string $resource = ShippingResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['id'] = auth()->id();

        return $data;
    }

    protected function getActions(): array
    {
        return [
            Action::make('view_pdf')
                ->label('Lihat Resi')
                ->url(fn ($record) => route('receipt.pdf', $record->id))
                ->openUrlInNewTab(),
        ];
    }
}
