<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\DB;

/**
 * Top 5 URL paling banyak dikunjungi (page views) dalam 30 hari terakhir.
 */
class TopPagesTableWidget extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Halaman terpopuler (30 hari terakhir)')
            ->records(fn (): array => $this->topPageRecords())
            ->columns([
                TextColumn::make('rank')
                    ->label('#')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('url')
                    ->label('URL')
                    ->wrap()
                    ->limit(80),
                TextColumn::make('views')
                    ->label('Page views')
                    ->numeric()
                    ->alignEnd(),
            ]);
    }

    /**
     * @return array<string, array{rank: int, url: string, views: int}>
     */
    private function topPageRecords(): array
    {
        $since = now()->subDays(30)->startOfDay();

        $rows = DB::table('visitors')
            ->where('visited_at', '>=', $since)
            ->selectRaw('url, COUNT(*) as views')
            ->groupBy('url')
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        $out = [];
        foreach ($rows as $index => $row) {
            $key = 'top-'.$index;
            $out[$key] = [
                'rank' => $index + 1,
                'url' => (string) $row->url,
                'views' => (int) $row->views,
            ];
        }

        return $out;
    }
}
