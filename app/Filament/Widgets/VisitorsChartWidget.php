<?php

namespace App\Filament\Widgets;

use App\Models\Visitor;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Grafik pengunjung unik per hari (7 hari terakhir), data siap formar Chart.js.
 */
class VisitorsChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Pengunjung unik (7 hari terakhir)';

    protected ?string $description = 'Jumlah visitor_id berbeda per tanggal';

    protected int|string|array $columnSpan = 'full';

    protected string $color = 'success';

    protected function getType(): string
    {
        return 'line';
    }

    /**
     * @return array{datasets: list<array{label: string, data: list<int>}>, labels: list<string>}
     */
    protected function getData(): array
    {
        $expr = $this->dayExpression();
        $start = now()->subDays(6)->startOfDay();

        $rows = Visitor::query()
            ->where('visited_at', '>=', $start)
            ->selectRaw("{$expr} as day")
            ->selectRaw('COUNT(DISTINCT visitor_id) as visitors')
            ->groupBy(DB::raw($expr))
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $labels = [];
        $points = [];

        // Pastikan 7 titik (termasuk hari dengan 0 visitor)
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->startOfDay();
            $key = $date->format('Y-m-d');
            $labels[] = $date->translatedFormat('D j/n');
            $points[] = (int) ($rows[$key]->visitors ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengunjung unik',
                    'data' => $points,
                ],
            ],
            'labels' => $labels,
        ];
    }

    /**
     * Ekspresi tanggal agregasi — kompatibel MySQL/MariaDB & SQLite.
     */
    private function dayExpression(): string
    {
        // Pakai format Y-m-d konsisten agar cocok dengan kunci loop PHP
        return match (Schema::getConnection()->getDriverName()) {
            'sqlite' => "strftime('%Y-%m-%d', visited_at)",
            'pgsql' => "to_char(visited_at, 'YYYY-MM-DD')",
            default => "DATE_FORMAT(visited_at, '%Y-%m-%d')",
        };
    }
}
