<?php

namespace App\Filament\Widgets;

use App\Models\Visitor;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Ringkasan pengunjung unik & page view untuk hari ini dan bulan berjalan.
 */
class VisitorStatsOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $todayStart = Carbon::today()->startOfDay();
        $todayEnd = Carbon::today()->endOfDay();

        $monthStart = Carbon::now()->startOfMonth()->startOfDay();
        $monthEnd = Carbon::now()->endOfDay();

        $visitorsToday = Visitor::distinctVisitorCount($todayStart, $todayEnd);
        $visitorsMonth = Visitor::distinctVisitorCount($monthStart, $monthEnd);

        $viewsToday = Visitor::pageViewCount($todayStart, $todayEnd);
        $viewsMonth = Visitor::pageViewCount($monthStart, $monthEnd);

        return [
            Stat::make('Pengunjung unik (hari ini)', number_format($visitorsToday))
                ->description('Berdasarkan cookie visitor_id')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Pengunjung unik (bulan ini)', number_format($visitorsMonth))
                ->description('Bulan kalender: '.$monthStart->translatedFormat('M Y'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),

            Stat::make('Page views (hari ini)', number_format($viewsToday))
                ->description('Setiap request halaman tercatat sekali')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            Stat::make('Page views (bulan ini)', number_format($viewsMonth))
                ->description('Bulan kalender: '.$monthStart->translatedFormat('M Y'))
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary'),
        ];
    }
}
