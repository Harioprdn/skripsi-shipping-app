<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingResource\Pages;
use App\Filament\Resources\ShippingResource\RelationManagers;
use App\Models\Shipping;
use App\Models\City;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippingResource extends Resource
{
    protected static ?string $model = Shipping::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $label = 'Pengiriman';

    protected static ?string $pluralLabel = 'Pengiriman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('number')
                    ->default('MC' . random_int(10000000, 99999999))
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(32)
                    ->unique(Shipping::class, 'number', ignoreRecord: true),

                // Forms\Components\ToggleButtons::make('status')
                //     ->inline()
                //     ->options(OrderStatus::class)
                //     ->required(),

                Forms\Components\TextInput::make('sender_name')
                    ->label('Nama Pengirim')
                    ->required(),

                Forms\Components\TextInput::make('sender_address')
                    ->label('Alamat Pengirim')
                    ->required(),

                Forms\Components\TextInput::make('sender_phone')
                    ->label('Telp. Pengirim')
                    ->required(),

                Forms\Components\TextInput::make('receiver_name')
                    ->label('Nama Penerima')
                    ->required(),

                Forms\Components\TextInput::make('receiver_address')
                    ->label('Alamat Penerima')
                    ->required(),

                Forms\Components\TextInput::make('receiver_phone')
                    ->label('Telp. Penerima')
                    ->required(),

                Forms\Components\Select::make('cities_id')
                    ->options(City::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label('Kota Tujuan')
                    ->searchable(),

                Forms\Components\Select::make('items_id')
                    ->options(Item::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label('Jenis Barang')
                    ->searchable(),

                Forms\Components\TextInput::make('item_count')
                    ->label('Jumlah  Barang')
                    ->required(),

                Forms\Components\TextInput::make('item_weight')
                    ->label('Berat')
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Keterangan')
                    ->nullable(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('number')
                    ->label('No Resi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sender_name')
                    ->label('Nama Pengirim')
                    ->searchable(),

                // Tables\Columns\TextColumn::make('sender_address')
                //     ->sortable()
                //     ->label('Alamat Pengirim')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('sender_phone')
                //     ->sortable()
                //     ->label('Telp Pengirim')
                //     ->searchable(),

                Tables\Columns\TextColumn::make('receiver_name')
                    ->label('Nama Penerima')
                    ->searchable(),

                // Tables\Columns\TextColumn::make('receiver_address')
                //     ->sortable()
                //     ->label('Alamat Penerima')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('receiver_phone')
                //     ->sortable()
                //     ->label('Telp Penerima')
                //     ->searchable(),

                Tables\Columns\TextColumn::make('cities.name')
                    ->label('Kota Tujuan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('items.name')
                    ->label('Jenis Barang')
                    ->searchable(),

                // Tables\Columns\TextColumn::make('item_count')
                //     ->sortable()
                //     ->label('Jumlah Barang')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('item_weight')
                //     ->sortable()
                //     ->label('Berat')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('date')
                //     ->sortable()
                //     ->label('Tanggal')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('price')
                //     ->sortable()
                //     ->label('Harga')
                //     ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make('view_record')
                    ->label('Lihat Data'),
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
            'index' => Pages\ListShippings::route('/'),
            'create' => Pages\CreateShipping::route('/create'),
            'edit' => Pages\EditShipping::route('/{record}/edit'),
        ];
    }
}
