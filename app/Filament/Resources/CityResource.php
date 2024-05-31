<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\City;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

    protected static ?string $label = 'Kota Tujuan';

    protected static ?string $pluralLabel = 'Kota Tujuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Kota Tujuan')
                    ->required(),

                // Forms\Components\TextInput::make('city_code')
                //     ->label('Kode Kota')
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Kota Tujuan')
                    ->searchable()
                    ->sortable(),

                // Tables\Columns\TextColumn::make('city_code')
                //     ->label('Kode Kota')
                //     ->searchable()
                //     ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
