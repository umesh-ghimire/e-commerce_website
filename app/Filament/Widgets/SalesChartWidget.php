<?php
// app/Filament/Widgets/SalesChartWidget.php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;
use Carbon\Carbon;

class SalesChartWidget extends ChartWidget
{
    // NOT static - remove 'static' keyword
    protected ?string $heading = 'Sales Overview';
    
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $data = $this->getMonthlySales();
        
        return [
            'datasets' => [
                [
                    'label' => 'Revenue (₹)',
                    'data' => $data['revenue'],
                    'borderColor' => '#4f46e5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getMonthlySales(): array
    {
        $months = [];
        $revenue = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $monthlyRevenue = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total');
            
            $revenue[] = round($monthlyRevenue, 2);
        }

        return [
            'months' => $months,
            'revenue' => $revenue,
        ];

        
    }

    
}