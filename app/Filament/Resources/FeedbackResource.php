<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $slug = 'feedbacks';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left';

    protected static ?string $navigationGroup = 'Pesan';

    protected static ?string $label = 'Ulasan';

    protected static ?int $navigationSort = 3;

    public static function getFormSchema()
    {
        return [

            Forms\Components\Section::make('Data Diri')
                ->description('Mohon isi formulir dibawah untuk mengisi data diri')
                ->schema([

                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->required(),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->required(),

                    Forms\Components\TextInput::make('phone')
                        ->label('No.Telp')
                        ->required(),

                ]),

            Forms\Components\Section::make('Ulasan')
                ->description('Berikan ulasan anda mengenai pelayanan kami')
                ->schema([

                    Forms\Components\TextInput::make('receipt_number')
                        ->label('Nomor Resi')
                        ->required(),

                    Forms\Components\ToggleButtons::make('rating')
                        ->label('Apakah Anda Menyukai Layanan Kami?')
                        ->options([
                            'Like' => 'Ya',
                            'Dislike' => 'Tidak',
                        ])
                        ->colors([
                            'Like' => 'success',
                            'Dislike' => 'danger',
                        ])
                        ->icons([
                            'Like' => 'heroicon-m-hand-thumb-up',
                            'Dislike' => 'heroicon-m-hand-thumb-down',
                        ])
                        ->inline()
                        ->inlineLabel(false)
                        ->required(),

                    Forms\Components\TextInput::make('title')
                        ->label('Judul Ulasan'),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi Ulasan'),

                ]),

            Forms\Components\DatePicker::make('date')
                ->label('Tanggal Pemesanan')
                ->required(),
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
                    ->label('Nama Pengirim'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\TextColumn::make('receipt_number')
                    ->label('Nomor Resi'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Ulasan'),

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal Pemesanan')
                    ->badge(),
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
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'view' => Pages\ViewFeedback::route('/{record}'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
