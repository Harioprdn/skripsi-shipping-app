<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CostResource\Pages;
use App\Filament\Resources\CostResource\RelationManagers;
use App\Models\Cost;
use App\Models\City;
use App\Models\Item;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CostResource extends Resource
{
    protected static ?string $model = Cost::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $label = 'Biaya Pengiriman';

    protected static ?string $pluralLabel = 'Biaya Pengiriman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cities_id')
                    ->options(City::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label('Kota Tujuan')
                    ->searchable(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->prefix('Rp')
                    ->label('Biaya Pengiriman'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('cities.name')
                    ->label('Kota Tujuan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->prefix('Rp ')
                    ->label('Biaya Pengiriman'),
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
            'index' => Pages\ListCosts::route('/'),
            'create' => Pages\CreateCost::route('/create'),
            'edit' => Pages\EditCost::route('/{record}/edit'),
        ];
    }
}
