<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ShippingResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class NewShipping extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(ShippingResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('No Resi'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->icon(fn (string $state): string => match ($state) {
                        'Baru' => 'heroicon-m-sparkles',
                        'Diproses' => 'heroicon-m-arrow-path',
                        'Terkirim' => 'heroicon-m-check-badge',
                        'Dibatalkan' => 'heroicon-m-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Baru' => 'info',
                        'Diproses' => 'warning',
                        'Terkirim' => 'success',
                        'Dibatalkan' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('sender_name')
                    ->label('Pengirim'),

                Tables\Columns\TextColumn::make('receiver_name')
                    ->label('Penerima'),

                Tables\Columns\TextColumn::make('costs.cities.name')
                    ->label('Tujuan'),

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal Pemesanan')
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('payment')
                    ->label('Pembayaran Oleh')
                    ->badge()
                    ->color('warning'),
            ]);
    }
}
