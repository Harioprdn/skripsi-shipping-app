<?php

namespace App\Livewire;

use App\Filament\Resources\CostResource;
use App\Models\Cost;
use App\Models\City;
use Filament\Forms\Components\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;

class ShowCosts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Cost::query())
            ->columns([
                TextColumn::make('cities.name')
                    ->label('Kota Tujuan')
                    ->searchable(),

                TextColumn::make('price')
                    ->prefix('Rp ')
                    ->label('Biaya Pengiriman'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.show-costs');
    }
}
