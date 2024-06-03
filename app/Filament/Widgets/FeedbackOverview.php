<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class FeedbackOverview extends BaseWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {

        $countLike = DB::table('feedback')->where('rating', 'Like')->count();
        $countDislike = DB::table('feedback')->where('rating', 'Dislike')->count();
        $countReport = DB::table('reports')->count();

        return [
            Stat::make('Ulasan', $countLike)
                ->description('Menyukai Layanan')
                ->descriptionIcon('heroicon-m-hand-thumb-up', IconPosition::Before)
                ->color('success'),
            Stat::make('Ulasan', $countDislike)
                ->description('Tidak Menyukai Layanan')
                ->descriptionIcon('heroicon-m-hand-thumb-down', IconPosition::Before)
                ->color('danger'),
            Stat::make('Laporan', $countReport)
        ];
    }
}
