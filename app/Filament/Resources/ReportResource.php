<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $slug = 'reports';

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationGroup = 'Pesan';

    protected static ?string $label = 'Laporan';

    protected static ?int $navigationSort = 3;

    public static function getFormSchema(): array
    {
        return [
            Section::make()
                ->description('Silahkan isi formulir untuk mengirimkan pesan')
                ->schema([

                    Forms\Components\Section::make('Data Diri')
                        ->schema([

                            Forms\Components\TextInput::make('name')
                                ->label('Nama')
                                ->required(),

                            Forms\Components\TextInput::make('email')
                                ->label('Email'),

                            Forms\Components\TextInput::make('phone')
                                ->label('Nomor Handphone')
                                ->required(),
                        ]),


                    Forms\Components\TextInput::make('subject')
                        ->label('Subjek')
                        ->required(),

                    Forms\Components\Textarea::make('message')
                        ->label('Pesan')
                        ->required()
                ])
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('No Handphone'),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Subjek'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
            'view' => Pages\ViewReport::route('/{record}'),
        ];
    }
}
