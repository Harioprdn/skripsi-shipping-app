<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Data';

    protected static ?string $label = 'Kendaraan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Informasi Umum')
                    ->schema([

                        Forms\Components\TextInput::make('type')
                            ->label('Jenis Kendaraan')
                            ->required(),

                        Forms\Components\TextInput::make('brand')
                            ->label('Merk')
                            ->required(),

                        Forms\Components\TextInput::make('number')
                            ->label('Plat Nomor')
                            ->required(),
                    ]),


                Forms\Components\Section::make('Pemeliharaan Kendaraan')
                    ->schema([

                        Forms\Components\DatePicker::make('production')
                            ->label('Tanggal Pembuatan')
                            ->required(),

                        Forms\Components\DatePicker::make('tax_date')
                            ->label('Pajak Berlaku Hingga')
                            ->required(),

                        Forms\Components\TextInput::make('tax_price')
                            ->label('Biaya Pajak')
                            ->prefix('Rp')
                            ->required(),

                        Forms\Components\DatePicker::make('oil_date')
                            ->label('Penggatian Oli Terakhir')
                            ->required(),

                        Forms\Components\TextInput::make('machine_number')
                            ->label('Nomor Mesin')
                            ->required(),

                        Forms\Components\TextInput::make('chassis_number')
                            ->label('Nomor Rangka')
                            ->required(),

                        Forms\Components\TextInput::make('color')
                            ->label('Warna')
                            ->required(),

                        Forms\Components\TextInput::make('fuel')
                            ->label('Bahan Bakar')
                            ->required(),
                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis Kendaraan'),

                Tables\Columns\TextColumn::make('brand')
                    ->label('Merk'),

                Tables\Columns\TextColumn::make('number')
                    ->label('Plat Nomor'),
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
