<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ShippingOverview extends BaseWidget
{

    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $countNew = DB::table('shippings')->where('status', 'Baru')->count();
        $countPending = DB::table('shippings')->where('status', 'Diproses')->count();
        $countDelivered = DB::table('shippings')->where('status', 'Terkirim')->count();
        $countCancelled = DB::table('shippings')->where('status', 'Dibatalkan')->count();


        return [
            Stat::make('Pengiriman', $countNew)
                ->description('Pesanan Baru')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info'),
            Stat::make('Pengiriman', $countPending)
                ->description('Pesanan Diproses')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),
            Stat::make('Pengiriman', $countDelivered)
                ->description('Pesanan Terkirim')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Pengiriman', $countCancelled)
                ->description('Pesanan Dibatalkan')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
