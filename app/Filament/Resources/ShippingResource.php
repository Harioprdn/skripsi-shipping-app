<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingResource\Pages;
use App\Filament\Resources\ShippingResource\RelationManagers;
use App\Models\Shipping;
use App\Models\City;
use App\Models\Cost;
use App\Models\Item;
use DateTime;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippingResource extends Resource
{
    protected static ?string $model = Shipping::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?int $navigationSort = 2;

    protected static ?string $label = 'Pengiriman';

    protected static ?string $pluralLabel = 'Pengiriman';

    public function calculateShippingCost($request)
    {
        $cityId = $request->input('cities_id');
        $itemId = $request->input('items_id');
        $quantity = $request->input('quantity');

        // Mendapatkan biaya pengiriman berdasarkan kota dan jenis barang
        $cost = Cost::where('city_id', $cityId)
            ->where('item_id', $itemId)
            ->first();

        // Validasi jika biaya tidak ditemukan
        if (!$cost) {
            return ['error' => 'Cost not found'];
        }

        // Menghitung total biaya berdasarkan jumlah barang
        $totalCost = $cost->cost_per_item * $quantity;

        return ['total_cost' => $totalCost];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('number')
                            ->label('Nomor Resi')
                            ->default('MC' . date('ym') . random_int(10000000, 99999999))
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->maxLength(32)
                            ->unique(Shipping::class, 'number', ignoreRecord: true),

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
                            ->default('Baru')
                            ->live(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Section::make('Data Pengirim')
                            ->schema([
                                Forms\Components\TextInput::make('sender_name')
                                    ->label('Nama Pengirim')
                                    ->required(),

                                Forms\Components\TextInput::make('sender_address')
                                    ->label('Alamat Pengirim')
                                    ->required(),

                                Forms\Components\TextInput::make('sender_phone')
                                    ->label('Telp. Pengirim')
                                    ->required(),
                            ])
                            ->columnSpan(1),

                        Forms\Components\Section::make('Data Penerima')
                            ->schema([
                                Forms\Components\TextInput::make('receiver_name')
                                    ->label('Nama Penerima')
                                    ->required(),

                                Forms\Components\TextInput::make('receiver_address')
                                    ->label('Alamat Penerima')
                                    ->required(),

                                Forms\Components\TextInput::make('receiver_phone')
                                    ->label('Telp. Penerima')
                                    ->required(),
                            ])
                            ->columnSpan(1),
                    ])
                    ->columns(2),



                Forms\Components\Section::make('Informasi Pengiriman')
                    ->schema([
                        Forms\Components\Select::make('costs_id')
                            ->options(Cost::all()->pluck('cities.name', 'id')->toArray())
                            ->required()
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('price', Cost::find($state)?->price ?? 0))
                            ->reactive()
                            ->label('Kota Tujuan')
                            ->searchable(),

                        Forms\Components\Select::make('items_id')
                            ->options(Item::all()->pluck('name', 'id')->toArray())
                            ->label('Jenis Barang')
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Jumlah  Barang')
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('item_weight')
                            ->label('Berat')
                            ->numeric()
                            ->suffix(' Kg')
                            ->required(),

                    ]),

                Forms\Components\Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\ToggleButtons::make('payment')
                            ->inline()
                            ->required()
                            ->label('Pembayaran dilakukan oleh: ')
                            ->options([
                                'Pengirim' => 'Pengirim',
                                'Penerima' => 'Penerima',
                            ]),

                        Forms\Components\TextInput::make('price')
                            ->label('Biaya')
                            ->prefix('Rp. ')
                            ->numeric()
                            ->dehydrated()
                            ->required(),

                    ])
                    ->columns(2),

                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal Pemesanan')
                    ->required(),

                Forms\Components\MarkdownEditor::make('description')
                    ->label('Keterangan')
                    ->nullable(),

            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('number')
                    ->label('No Resi')
                    ->searchable(),

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
                    ->label('Pengirim')
                    ->searchable(),

                Tables\Columns\TextColumn::make('receiver_name')
                    ->label('Penerima')
                    ->searchable(),

                Tables\Columns\TextColumn::make('costs.cities.name')
                    ->label('Tujuan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal Pemesanan')
                    ->sortable()
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('payment')
                    ->label('Pembayaran Oleh')
                    ->badge()
                    ->color('warning'),

            ])
            ->filters([

                // Tables\Filters\SelectFilter::make('status')
                //     ->options([
                //         'Baru' => 'Baru',
                //         'Diproses' => 'Diproses',
                //         'Terkirim' => 'Terkirim',
                //         'Dibatalkan' => 'Dibatalkan',
                //     ])

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Baru' => 'Baru',
                        'Diproses' => 'Diproses',
                        'Terkirim' => 'Terkirim',
                        'Dibatalkan' => 'Dibatalkan'
                    ])
                    ->attribute('status'),

                Tables\Filters\SelectFilter::make('payment')
                    ->options([
                        'Pengirim' => 'Pengirim',
                        'Penerima' => 'Penerima',
                    ])
                    ->attribute('payment'),

            ])

            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                ])
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
            'view' => Pages\ViewShipping::route('/{record}'),
        ];
    }
}
