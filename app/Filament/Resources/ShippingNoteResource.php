<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingNoteResource\Pages;
use App\Filament\Resources\ShippingNoteResource\RelationManagers;
use App\Models\Driver;
use App\Models\Shipping;
use App\Models\ShippingNote;
use App\Models\Vehicle;
use DateTime;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
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

    protected static ?int $navigationSort = 3;

    protected static ?string $label = 'Surat Jalan';

    protected static ?string $pluralLabel = 'Surat Jalan';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                Forms\Components\Select::make('drivers_id')
                    ->options(Driver::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label('Pilih Kurir')
                    ->searchable(),

                Forms\Components\Repeater::make('shippings_id')
                    ->label('Pilih Pengiriman')
                    ->schema([
                        Forms\Components\Select::make('shippings_id')
                            ->options(Shipping::all()->pluck('number', 'id')->toArray())
                            ->required()
                            ->reactive()
                            ->distinct()
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('date', Shipping::find($state)?->date ?? 0))
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('status', Shipping::find($state)?->status ?? 0))
                            ->label('Pilih Pengiriman')
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->searchable()
                            ->columnSpan([
                                'md' => 3
                            ]),

                        Forms\Components\TextInput::make('date')
                            ->required()
                            ->label('Tanggal')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan([
                                'md' => 3
                            ]),

                        Forms\Components\ToggleButtons::make('status')
                            ->inline()
                            ->options([
                                'Baru' => 'Baru',
                                'Diproses' => 'Diproses',
                                'Terkirim' => 'Terkirim',
                                'Dibatalkan' => 'Dibatalkan'
                            ])
                            ->colors([
                                'Baru' => 'info',
                                'Diproses' => 'warning',
                                'Terkirim' => 'success',
                                'Dibatalkan' => 'danger',
                            ])
                            ->icons([
                                'Baru' => 'heroicon-m-sparkles',
                                'Diproses' => 'heroicon-m-arrow-path',
                                'Terkirim' => 'heroicon-m-check-badge',
                                'Dibatalkan' => 'heroicon-m-x-circle',
                            ])

                            ->required()
                            ->label('Status')
                            ->live()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan([
                                'md' => 4
                            ])
                    ])
                    ->columns([
                        'md' => 10
                    ]),

                Forms\Components\Select::make('vehicles_id')
                    ->options(Vehicle::all()->pluck('type', 'id')->toArray())
                    ->label('Kendaraan')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('vehicles.number')
                    ->options(Vehicle::all()->pluck('number', 'id')->toArray())
                    ->label('Plat Nomor')
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('shippings_date')
                    ->label('Tanggal Pengiriman')
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('drivers.name')
                    ->label('Kurir')
                    ->searchable(),

                Tables\Columns\TextColumn::make('vehicle')
                    ->label('Kendaraan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('number_plate')
                    ->label('Plat Nomor'),

                Tables\Columns\TextColumn::make('shippings_date')
                    ->label('Tanggal Pengiriman')
                    ->badge()
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
