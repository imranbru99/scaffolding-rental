<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class JobsChart extends ChartWidget
{
    protected static ?string $heading = 'Jobs by Status';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $rows = Project::query()
            ->select('status', DB::raw('count(*) as aggregate'))
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Jobs',
                    'data' => $rows->values()->all(),
                    'backgroundColor' => ['#FF6B35', '#1B4332', '#415A77', '#22c55e', '#64748b', '#ef4444'],
                ],
            ],
            'labels' => $rows->keys()->map(fn ($s) => str_replace('_', ' ', ucfirst($s)))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
