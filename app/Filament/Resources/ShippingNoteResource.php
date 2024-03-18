<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingNoteResource\Pages;
use App\Filament\Resources\ShippingNoteResource\RelationManagers;
use App\Models\Driver;
use App\Models\Shipping;
use App\Models\ShippingNote;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippingNoteResource extends Resource
{
    protected static ?string $model = ShippingNote::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $label = 'Surat Jalan';

    protected static ?string $pluralLabel = 'Surat Jalan';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                Forms\Components\Select::make('driver_id')
                    ->options(Driver::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label('Pilih Kurir')
                    ->searchable(),

                Repeater::make('shipping_id')
                    ->label('Pilih Pengiriman')
                    // ->relationship()
                    ->schema([
                        Forms\Components\Select::make('shippings_id')
                            ->options(Shipping::all()->pluck('number', 'id')->toArray())
                            ->required()
                            ->label('')
                            ->searchable(),
                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                        $data['drivers_id'] = auth()->id();

                        return $data;
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('drivers.name')
                //     ->label('Kurir')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('shippings.number')
                //     ->label('Pengiriman')
                //     ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShippingNotes::route('/'),
            'create' => Pages\CreateShippingNote::route('/create'),
            'edit' => Pages\EditShippingNote::route('/{record}/edit'),
        ];
    }
}
