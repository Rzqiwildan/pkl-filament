<?php

namespace App\Filament\Widgets;

use App\Models\UserPelatihan;
use Filament\Widgets\ChartWidget;

class PelatihanChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Pelatihan';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Peserta Pelatihan',
                    'data' => UserPelatihan::selectRaw('COUNT(*) as count')
                        ->groupBy('pelatihan_id')
                        ->pluck('count')
                        ->toArray(),
                        'backgroundColor' => [
                        '#FF6384', 
                        '#36A2EB', 
                        '#FFCE56', 
                        '#4BC0C0', 
                        '#9966FF', 
                        '#FF9F40', 
                        '#C9CBCF', 
                    ],
                ],
            ],
            'labels' => UserPelatihan::with('pelatihan')
                ->get()
                ->pluck('pelatihan.name')
                ->unique()
                ->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
            'elements' => [
                'arc' => [
                    'borderWidth' => 2,
                    'borderColor' => '#fff', // Menambahkan garis pemisah putih di sekitar setiap segmen
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}